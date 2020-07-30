<?php

/**
 * Template Name: Favorites overview
 * Template Post Type: page
 */

use Timber\Post;
use Timber\Timber;
use App\Models\Product;
use App\Controllers\Functions\General\Favorites;

defined('ABSPATH') || exit(0);

$context              = Timber::get_context();
$context['post']      = new Post();
$context['favorites'] = Timber::get_posts(Favorites::get_user_favorites(), Product::class);
$context['user']      = wp_get_current_user();

$templates = [
    'templates/views/favorites.html.twig'
];

Timber::render($templates, $context);
