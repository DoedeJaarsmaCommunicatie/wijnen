<?php

namespace App\Controllers\Functions\General;

class Favorites
{
    public static function get_user_favorites_count()
    {
        return \get_user_favorites_count(null, get_current_blog_id());
    }

    public static function get_user_favorites()
    {
        return \get_user_favorites(null, get_current_blog_id());
    }
}
