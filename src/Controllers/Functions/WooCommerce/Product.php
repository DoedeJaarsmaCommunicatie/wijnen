<?php

namespace App\Controllers\Functions\WooCommerce;

use Carbon\Carbon;

class Product
{
    private static $dateTimeZone = 'Europe/Amsterdam';

    public static function orderBeforeTime()
    {
        return '15:00';
    }

    /**
     * @param null|int $product
     *
     * @return bool
     */
    public static function canShipToday($product = null)
    {
        if (!$product) {
            $product = \get_queried_object_id();
        }

        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $product = new \App\Models\Product($product);

        if ($product->is_dropshipped()) {
            return false;
        }

        return !Carbon::now(static::$dateTimeZone)
                      ->setTimeFromTimeString(static::orderBeforeTime())
                      ->isPast();
    }
}
