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
use App\Models\Product;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['post'] = new Product();
$context['product'] = Woo::getStaticCachedProduct($context['post']->ID);

$related_ids =  Woo::getStaticCachedRelatedProducts($context['product']->get_id(), 4);
$context['related_products'] =  Timber::get_posts($related_ids, Product::class);
if (function_exists('cvp_get_products')) {
    $context['variations'] = array_map(function ($arr) {
        return [
            'name' => $arr['name'],
            'products' => array_map(function ($arr2) {
                return new Product($arr2);
            }, (array) $arr['products']),
        ];
    }, cvp_get_flat_products(cvp_get_products()));
}


$templates = [
    Template::viewTwigFile('woocommerce/single-product'),
];

Timber::render(
    apply_filters('wijnen/view-composer/woo/single-product/templates', $templates),
    apply_filters('wijnen/view-composer/woo/single-product/context', $context)
);
