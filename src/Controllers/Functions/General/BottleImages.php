<?php

namespace App\Controllers\Functions\General;

use App\Helpers\WP;

defined('ABSPATH') || exit;

class BottleImages
{
    public static function getBottleUrl($name)
    {
        return WP::getAssetLocation(['dist', 'images', 'bottles', $name . '.png']);
    }
}
