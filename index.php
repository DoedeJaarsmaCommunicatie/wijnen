<?php
/**
 * The template to use when no other template files are found
 *
 * Usage:
 *  Add content to the $context array to use in the called template.
 *  Add templates via the filter or in the templates array.
 *
 *
 * @since 1.0.0
 * @version 1.0.0
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author Mitch Hijlkema
 */

use Timber\Post;
use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();

$context['post'] = new Post();

$templates = [
    Template::viewTwigFile('index'),
];

Timber::render(
    apply_filters('wijnen/view-composer/index/templates', $templates),
    apply_filters('wijnen/view-composer/index/context', $context)
);
