<?php
use Timber\Timber;

include_once get_stylesheet_directory() . '/vendor/autoload.php';

add_theme_support('custom-logo');
add_theme_support('woocommerce');

Timber::$locations = [
    get_stylesheet_directory() . '/templates/',
];

