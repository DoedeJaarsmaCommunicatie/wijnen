<?php

namespace App\Providers;

use Timber\Helper;
use App\Helpers\WP;
use Symfony\Component\Finder\Finder;

class ContentServiceProvider extends ServiceProvider {
	public function boot () {
		add_filter('timber/context', [$this, 'basic_additional_content']);
		add_filter('woocommerce_add_to_cart_fragments', [$this, 'cart_contents_count']);
	}

	public function basic_additional_content ($context)
	{
		if (true === get_theme_mod('cdelk_use_hash') && class_exists('cdk_hashed_model')) {
			$context['kiyoh'] = (new \cdk_hashed_model())->get();
		} elseif (class_exists('cdk_model')) {
			$context['kiyoh'] = (new \cdk_model())->get();
		} else {
			$context['kiyoh'] = false;
		}

		$context['secure_payment'] = static::get_cached_payment_icons();

		if (
			function_exists('wc')&&
			!is_admin() &&
			wc()->cart
		) {
			$context['wc_cart_count'] = wc()->cart->get_cart_contents_count();
		}

		return $context;
	}

	public function cart_contents_count($fragments)
	{
		if (!is_admin()) {
			$fragments['cart_contents_count'] = wc()->cart->get_cart_contents_count();
		}

		return $fragments;
	}

	public static function get_cached_payment_icons () {
		return Helper::transient('payment_icons', static function () {
			$finder = new Finder();

			return $finder
				->files()
				->in(WP::getStylesheetDir() . '/dist/images/payment_methods')
				->name('*.svg');
		}, 43800);
	}
}
