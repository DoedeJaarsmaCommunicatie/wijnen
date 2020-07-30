<?php
/**
 * This is for default pages.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Mitch Hijlkema
 */

use Timber\Post;
use Timber\Timber;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();

$context['post'] = new Post();

$templates = [
    Template::viewTwigFile('page'),
];

Timber::render(
    apply_filters('wijnen/view-composer/page/templates', $templates),
    apply_filters('wijnen/view-composer/page/context', $context)
);
