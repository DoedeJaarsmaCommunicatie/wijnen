<?php

namespace App\Controllers\Functions\General;

use Timber\Helper;
use Timber\PostQuery;

defined('ABSPATH') || exit;

class View
{
    protected static $cpt_cache = [];

    public static function get_cached_cpt_list($type)
    {
        if (isset(static::$cpt_cache[$type])) {
            return static::$cpt_cache[$type];
        }

        $pages = Helper::transient("random_10_posts_type_{$type}", function () use ($type) {
            $query = new PostQuery(
                [
                    'post_type' => $type,
                    'posts_per_page' => 10,
                    'orderby' => 'rand',
                    'order' => 'ASC',
                ]
            );

            return $query->get_posts();
        }, 86400);

        return static::$cpt_cache[$type] = $pages;
    }
}
