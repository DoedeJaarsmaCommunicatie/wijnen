<?php

namespace App\Controllers\Hooks\Filters\Shop;

use App\Controllers\Hooks\Filters\Filter;

class CustomStockStatus extends Filter
{
    public function filter($status = [])
    {
        $status ['dropshipped'] = 'Dropship';

        return $status;
    }

    public function hook()
    {
        return 'woocommerce_product_stock_status_options';
    }
}
