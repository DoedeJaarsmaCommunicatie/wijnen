<?php

namespace App\Controllers\Hooks\Filters\Views\WooCommerce;

use App\Controllers\Hooks\Filters\Filter;

class ChangeDefaultOrderBy extends Filter
{
    public function filter()
    {
	    return 'popularity';
    }

    public function hook()
    {
	    return 'woocommerce_default_catalog_orderby';
    }
}
