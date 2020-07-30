<?php
/**
 * The WooCommerce general product archive template.
 *
 * This uses WooCommerce versioning next to file versioning.
 *
 * @since 1.0.0
 * @file-version 1.0.0
 * @version 3.4.0
 */

use Timber\Timber;
use App\Models\Product;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['products'] = Timber::get_posts(false, Product::class); # This loads the products as an \App\Product model.

if (is_product_category()) {
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['category'] = get_term($term_id, 'product_cat');
    $context['title'] = single_term_title('', false);
}

if (isset($_GET['product-land'])) {
    $country = explode(',', $_GET['product-land']);

    $terms = get_terms([
        'taxonomy' => 'country',
        'slug' => $country[0],
        'fields' => 'ids'
    ]);

    $context['country'] = Timber::get_term($terms[0], 'country');
}

$templates = [
    Template::viewTwigFile('woocommerce/archive-product'),
];

Timber::render(
    apply_filters('wijnen/view-composer/woo/archive-product/templates', $templates),
    apply_filters('wijnen/view-composer/woo/archive-product/context', $context)
);
