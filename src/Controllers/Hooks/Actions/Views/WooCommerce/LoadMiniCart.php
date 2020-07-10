<?php

namespace App\Controllers\Hooks\Actions\Views\WooCommerce;

use Timber\Timber;
use App\Helpers\Template;
use App\Controllers\Hooks\Actions\Action;

class LoadMiniCart extends Action
{
	public function action()
	{
		$context = Timber::get_context();
		$context ['WC'] = WC();
		$context ['cart'] = WC()->cart;

		$templates = [
			Template::partialTwigFile('woocommerce/cart/mini-cart'),
		];

		Timber::render(
			apply_filters('wijnen/view-composer/woo/mini-cart/templates', $templates),
			apply_filters('wijnen/view-composer/woo/mini-cart/context', $context)
		);
	}

	public function hook()
	{
		return 'wijnen/html/woocommerce/mini-cart';
	}

}
