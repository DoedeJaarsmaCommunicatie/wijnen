<?php
/**
 * The search template, called when a request is made with `?s=` query param.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @see https://codex.wordpress.org/Creating_a_Search_Page
 * @author Mitch Hijlkema
 */

use Timber\Timber;
use Timber\PostQuery;
use App\Helpers\Template;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$context['posts'] = new PostQuery();
$context['search_query'] = get_search_query();

$templates = [
	Template::viewTwigFile('search'),
];

Timber::render(
	apply_filters('wijnen/view-composer/search/templates', $templates),
	apply_filters('wijnen/view-composer/search/context', $context)
);
