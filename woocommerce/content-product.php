<?php
/**
 * This loads the product tease content
 * used by elementor.
 *
 * @since 1.0.0
 * @file-version 1.0.0
 * @author Mitch Hijlkema
 */

use Timber\Timber;
use App\Helpers\Woo;
use App\Models\Product;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['post'] = new Product(get_queried_object_id());
$context['product'] = Woo::getStaticCachedProduct($context['post']->id);

$templates = [
	Template::partialHtmlTwigFile('tease/product-large'),
];

return Timber::render(
	apply_filters('wijnen/view-composer/woo/content-product/templates', $templates),
	apply_filters('wijnen/view-composer/woo/content-product/context', $context)
);
