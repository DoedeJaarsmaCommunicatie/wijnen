<?php
/**
 * A default file for single post type
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Mitch Hijlkema
 */

use App\Helpers\Template;
use Timber\Post;
use Timber\Timber;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$post = new Post();
$context['post'] = $post;

$templates = [
	Template::viewTwigFile("single/{$post->post_type}/{$post->slug}"),
	Template::viewTwigFile("single/{$post->post_type}"),
	Template::viewTwigFile('single'),
	Template::viewTwigFile('index'),
];

Timber::render($templates, $context);
