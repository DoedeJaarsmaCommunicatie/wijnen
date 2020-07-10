<?php

namespace App\Controllers\Http\Ajax\v1\Shop;

use Timber\Timber;
use App\Helpers\Template;
use App\Controllers\Http\Ajax\AjaxController;

class AddItemToCart extends AjaxController
{
    public function isPrivate(): bool
    {
        return false;
    }

    public function actionName(): string
    {
        return 'add_product_to_cart';
    }

    public function hookName(): string
    {
        return 'addToCart';
    }

    public function addToCart()
    {
        $request = $this->getRequestWithJson();

        $productID = apply_filters('wijnen/ajax/v1/shop/add-to-cart/product-id', $request->request->get('product_id', false));
        $quantity = apply_filters('wijnen/ajax/v1/shop/add-to-cart/qty', $request->request->get('qty', 1), $productID);
        $variationID = apply_filters('wijnen/ajax/v1/shop/add-to-cart/product-variation-id', $request->request->get('variation_id', 0));
        $postStatus = get_post_status($productID);

        if ($postStatus !== 'publish') {
            wp_send_json_error([
                'error_code' => 'PRODUCT_NOT_PUBLIC',
                'message' => __('Dit product kan niet worden toegevoegd aan je winkelmandje.', 'wijnen'),
                'post_status' => $postStatus,
            ], 403);
        }

        if (!$this->validate($productID, $quantity) || !WC()->cart->add_to_cart($productID, $quantity, $variationID)) {
            wp_send_json_error([
                'error_code' => 'REQUEST_NOT_VALID',
                'message' => __('Het product is niet toegevoegd aan je mandje.', 'wijnen')
            ], 500);
        }

        do_action('woocommerce_ajax_added_to_cart', $productID);

        wp_send_json_success([
            'message' => __('Product toegevoegd aan je winkelmandje!', 'wijnen'),
            'product' => $productID,
            'quantity' => $quantity,
	        'cart_count' => WC()->cart->get_cart_contents_count(),
	        'mini_cart' => $this->compileMiniCart(),
        ]);
    }


	protected function compileMiniCart(): string
	{
		$context = Timber::get_context();
		$context ['WC'] = WC();
		$context ['cart'] = WC()->cart;
		$context ['args'] = [
			'list_class' => 'from-ajax'
		];

		$templates = [
			Template::partialTwigFile('woocommerce/cart/mini-cart'),
		];

		return Timber::compile(
			apply_filters('wijnen/view-composer/woo/mini-cart/templates', $templates),
			apply_filters('wijnen/view-composer/woo/mini-cart/context', $context)
		);

	}

    protected function validate($productID, $quantity)
    {
        return apply_filters('woocommerce_add_to_cart_validation', true, $productID, $quantity);
    }
}
