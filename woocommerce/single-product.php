<?php
/**
 * The WooCommerce general product single template.
 *
 * This uses WooCommerce versioning next to file versioning.
 *
 * @since 1.0.0
 * @file-version 1.0.0
 * @version 1.6.4
 */

use Timber\Timber;
use App\Helpers\Woo;
use App\Helpers\Cookie;
use App\Models\Product;
use App\Helpers\Counter;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['post'] = new Product();
$context['product'] = Woo::getStaticCachedProduct($context['post']->ID);

$related_ids                 =  Woo::getStaticCachedRelatedProducts($context['product']->get_id(), 4);
$context['related_products'] =  Timber::get_posts($related_ids, Product::class);

$templates = [
	Template::viewTwigFile('woocommerce/single-product'),
];

Timber::render(
	apply_filters('wijnen/view-composer/woo/single-product/templates', $templates),
	apply_filters('wijnen/view-composer/woo/single-product/context', $context)
);
