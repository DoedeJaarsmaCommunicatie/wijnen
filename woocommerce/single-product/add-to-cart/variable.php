<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

use Timber\Timber;

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

$context = Timber::get_context();
$context['attributes'] = $attributes;
$context['product'] = $product;
$context['available_variations'] = $available_variations;
$context['variations_attr'] = $variations_attr;
$context['add_to_cart_url'] = esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) );

do_action( 'woocommerce_before_add_to_cart_form' );

return Timber::render(
    'partials/woocommerce/product/add-to-cart/variable.html.twig',
    $context
);
