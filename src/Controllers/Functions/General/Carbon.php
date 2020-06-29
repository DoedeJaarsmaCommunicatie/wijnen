<?php

namespace App\Controllers\Functions\General;

use App\Helpers\Log;
use App\Models\Product;
use Illuminate\Support\Str;
use function carbon_get_theme_option;

defined('ABSPATH') || exit;

class Carbon
{
	public static $theme_option_cache = [];
	public static $wine_otm_cache = [];

	public static function get_theme_option(string $name, $container = '')
	{
		if (isset(static::$theme_option_cache[$name])) {
			return static::$theme_option_cache[$name];
		}

		return static::$theme_option_cache[$name] = carbon_get_theme_option($name, $container);
	}

	public static function get_custom_page($page)
	{
		if (Str::endsWith('_page', $page)) {
			$page = Str::replaceArray('_page', '', $page);
		}


		$pagesArr = static::get_theme_option($page . '_page');

		if (count($pagesArr) < 1) {
			return false;
		}

		return get_permalink($pagesArr[0]['id']);
	}

	public static function get_wine_of_the_month($category)
	{
		$productArr = static::get_theme_option($category . '_wine_otm');

		if (count($productArr) < 1) {
			return false;
		}

		if (count($productArr) > 1) {
			Log::info('Too many Products of the month. Fetching first');
		}

		if (isset(static::$wine_otm_cache[$productArr[0]['id']])) {
			return static::$wine_otm_cache[$productArr[0]['id']];
		}

		return static::$wine_otm_cache[$productArr[0]['id']] = new Product($productArr[0]['id']);
	}
}
