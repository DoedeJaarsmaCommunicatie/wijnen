<?php
/**
 * The specific theme file for the `country` taxonomy.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Mitch Hijlkema
 */
defined('ABSPATH') || exit;

use App\Helpers\Template;
use Timber\Helper;
use Timber\Post;
use Timber\Term;
use Timber\Timber;

$context = Timber::get_context();
$post = new Post();
$term = new Term();

$context['term'] = $term;
$context['post'] = $post;

$context['products'] = Helper::transient(
    "taxonomy-country-{$term->slug}-products",
    static function () use ($term) {
        return Timber::get_posts([
            'type' => 'product',
            'tax_query'     => [
                [
                    'taxonomy'      => 'pa_land',
                    'field'         => 'slug',
                    'terms'         => $term->slug
                ],
            ]
        ]);
    },
    3600
);

$templates = [
	Template::viewHtmlTwigFile("taxonomy/country/{$term->slug}"),
    Template::viewHtmlTwigFile('taxonomy/country'),
    Template::viewHtmlTwigFile('taxonomy')
];

Timber::render(
	apply_filters('wijnen/view-composer/taxonomy-country/templates', $templates),
	apply_filters('wijnen/view-composer/taxonomy-country/context', $context)
);
