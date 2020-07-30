<?php
/**
 * The markup for the checkout form.
 *
 * @var \WC_Checkout $checkout
 *
 * @since 1.0.0
 * @file-version 1.0.0
 * @author Mitch Hijlkema
 */

use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['checkout'] = $checkout;

$templates = [
    Template::partialHtmlTwigFile('woocommerce/checkout/form'),
];

Timber::render(
    apply_filters('wijnen/view-composer/woo/form-checkout/templates', $templates),
    apply_filters('wijnen/view-composer/woo/form-checkout/context', $context)
);
