<?php


namespace App\Controllers\Http\Ajax\v1\Shop;

use App\Controllers\Http\Ajax\AjaxController;

class GetCrossSells extends AjaxController
{

    public function isPrivate(): bool
    {
        return false;
    }

    public function actionName(): string
    {
        return 'getCrossSells';
    }

    public function hookName(): string
    {
        return 'cart_cross_sells';
    }

    public function getCrossSells()
    {
    	$cart = WC()->cart;

    	return $cart->get_cross_sells();
    }
}
