<?php

namespace App\Controllers\Http\Ajax\v1\Common;

use Timber\PostQuery;
use App\Controllers\Http\Ajax\AjaxController;

class SearchResults extends AjaxController
{
    public function isPrivate(): bool
    {
        return false;
    }

    public function actionName(): string
    {
        return 'search_results';
    }

    public function hookName(): string
    {
        return 'fetchResults';
    }

    public function fetchResults()
    {
        $request = $this->getRequest();

        $postType = apply_filters('wijnen/ajax/v1/common/search-results/post-type', $request->query->get('post_type', false));
        $search = apply_filters('wijnen/ajax/v1/common/search-results/search-term', $request->query->get('s', ''));
        $category = apply_filters('wijnen/ajax/v1/common/search-results/category-type', $request->query->get('category', false));
        $limit = apply_filters('wijnen/ajax/v1/common/search-results/posts-per-page', $request->query->get('per_page', 10));

        $args = [
            's' => $search,
            'posts_per_page' => $limit
        ];

        if ($postType) {
            $args['post_type'] = $postType;
        }

        if ($category) {
            if ($postType === 'product') {
                $args['post_query'] []= [
                    'taxonomy' => 'product_cat',
                    'terms' => $category,
                    'field' => 'slug'
                ];
            } else {
                $args['category_name'] = $category;
            }
        }

        $posts = new \WP_Query($args);

        wp_send_json_success([
            'message' => __('Search results', 'wijnen'),
            'count' => $posts->post_count,
            'posts' => $posts->get_posts()
        ]);
    }
}
