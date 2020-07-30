<?php
/**
 * This template is called when a 404 error is thrown.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @see https://codex.wordpress.org/Creating_an_Error_404_Page
 * @author Mitch Hijlkema
 */

use Timber\Post;
use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['post'] = new Post();

$templates = [
    Template::viewHtmlTwigFile('404'),
];

Timber::render(
    apply_filters('wijnen/view-composers/404/templates', $templates),
    apply_filters('wijnen/view-composers/404/context', $context)
);
