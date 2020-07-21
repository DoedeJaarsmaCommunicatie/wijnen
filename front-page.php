<?php

/**
 * The front-page view composer file. This handles the data to
 * show a nice front-page.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Mitch Hijlkema
 */

use App\Models\Post;
use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$post = new Post();

$context['post'] = $post;

$templates = [
    Template::viewTwigFile('front-page'),
    Template::viewTwigFile('index'),
];

Timber::render(
    apply_filters('wijnen/view-composer/front-page/templates', $templates),
    apply_filters('wijnen/view-composer/front-page/context', $context)
);
