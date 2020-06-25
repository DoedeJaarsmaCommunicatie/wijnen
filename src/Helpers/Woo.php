<?php

namespace App\Helpers;

use Timber\Helper;
use Timber\PostQuery;
use App\Models\Product;
use App\Models\VariableProduct;

class Woo
{
	protected static $products_cache_arr = [];
	protected static $products_related_cache_arr = [];

	public static function getStaticCachedRelatedProducts(int $product_id, int $limit = 4)
	{
		if (isset(static::$products_related_cache_arr[$product_id]) && count(static::$products_related_cache_arr) === $limit) {
			return static::$products_related_cache_arr[$product_id];
		}

		return static::$products_related_cache_arr[$product_id] = wc_get_related_products($product_id, $limit);
	}

	public static function getStaticCachedProduct(int $product_id)
	{
		if (isset(static::$products_cache_arr[$product_id])) {
			return static::$products_cache_arr[$product_id];
		}

		return static::$products_cache_arr[$product_id] = wc_get_product($product_id);
	}

    public static function getPopularProducts($limit = 4)
    {
        return Helper::transient('_wc_popular_products', static function () use ($limit) {
            $args = [
                'post_type' => 'product',
                'posts_per_page' => $limit,
                'orderby' => 'meta_value_num',
                'order' => 'desc',
                'meta_key' => '_product_view_count'
            ];


            $posts = [];

            /** @var Product $post */
            foreach (new PostQuery($args, \App\Models\Product::class) as $post) {
                if ($post->setProduct()->is_type('variable')) {
                    $posts[] = new VariableProduct($post->id);
                } else {
                    $posts[] = new Product($post->id);
                }
            }

            return $posts;
        }, 3600);
    }

    public static function getNewProducts($limit = 4)
    {
        return Helper::transient('_wc_last_modified_products', static function () use ($limit) {
            $args = [
                'post_type' => 'product',
                'orderby' => 'modified',
                'order' => 'DESC',
                'posts_per_page' => $limit
            ];

            $posts = [];

            /** @var Product $post */
            foreach (new PostQuery($args, \App\Models\Product::class) as $post) {
                if ($post->setProduct()->is_type('variable')) {
                    $posts[] = new VariableProduct($post->id);
                } else {
                    $posts[] = new Product($post->id);
                }
            }

            return $posts;
        }, 600);
    }

    public static function setProductView(int $product)
    {
        $key = '_product_view_count';
        $viewCount = get_post_meta($product, $key, true);

        if (!$viewCount) {
            add_post_meta($product, $key, 1);
        } else {
            update_post_meta($product, $key, (int) $viewCount + 1);
        }
    }
}
