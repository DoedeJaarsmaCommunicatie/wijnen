<?php

namespace App\Controllers\Functions\WooCommerce;

defined('ABSPATH') || exit(0);

class WooCommerceGeneral
{
    protected static $url_cache = [];

    /**
     * Gets the current shop page
     *
     * @return string
     */
    public static function getShopUrl(): string
    {
        return static::getUrl('shop');
    }

    public static function getCartUrl(): string
    {
        return static::getUrl('cart');
    }

    public static function getAccountUrl(): string
    {
    	return static::getUrl('myaccount');
    }

    public static function getCheckoutUrl(): string
    {
    	return static::getUrl('checkout');
    }

    public static function getUrl(string $page): string
    {
        if (isset(static::$url_cache[$page])) {
            return static::$url_cache[$page];
        }

        return static::$url_cache[$page] = get_permalink(wc_get_page_id($page));
    }
}
