<?php

namespace App\Controllers\Http\Ajax\v1\Shop;

use App\Controllers\Resources\Api\Product;
use App\Controllers\Http\Ajax\AjaxController;

class CurrentUserCartItems extends AjaxController
{

    public function isPrivate(): bool
    {
        return false;
    }

    public function actionName(): string
    {
        return 'get_cart_item_count';
    }

    public function hookName(): string
    {
        return 'getCartItems';
    }

    public function getCartItems()
    {
        $cart = WC()->cart;
        $products = [];

        foreach ($cart->get_cart() as $key => $value) {
            $products []= (new Product(apply_filters('wijnen/view/cart/product-from-id', $value['product_id']), $value))->toArray();
        }

        wp_send_json_success([
            'cart_items_count' => $cart->get_cart_contents_count(),
            'cart_items' => $products,
        ]);
    }
}
