<?php

namespace App\Controllers\Functions\General;

defined('ABSPATH') || exit;

class BottleImages
{
	public static function getBottleUrl($name)
	{
		return \App\Helpers\WP::getAssetLocation(['dist', 'images', 'bottles', $name . '.png']);
	}
}
