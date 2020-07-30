<?php
/**
 * Mini-cart
 *
 * @var $args
 *
 * @since 1.0.0
 * @version 3.7.0
 * @file-version 1.0.0
 */

use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context ['WC'] = WC();
$context ['cart'] = WC()->cart;
$context ['args'] = $args;

$templates = [
    Template::partialTwigFile('woocommerce/cart/mini-cart'),
];

Timber::render(
    apply_filters('wijnen/view-composer/woo/mini-cart/templates', $templates),
    apply_filters('wijnen/view-composer/woo/mini-cart/context', $context)
);
