<?php
/**
 * A specified template file to handle single posts of the
 * `Producent` custom post type.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Mitch Hijlkema
 */


use Timber\Post;
use Timber\Timber;
use App\Helpers\Template;
use Elderbraum\CasaProductFactory\Products\Newest;
use Elderbraum\CasaProductFactory\ProductsFactory;

defined('ABSPATH') || exit;

$context = Timber::get_context();
$post = new Post();
$context['post'] = $post;

/** @var Newest $products */
$products = ProductsFactory::create(Newest::class);
$products->boot();
$products->add_args(
    [
        'tax_query'     => [
            [
                'taxonomy'  => 'pa_domein',
                'field'     => 'slug',
                'operator'  => 'IN',
                'terms'     => $context['post']->slug
            ]
        ]
    ]
);

if ($products->initialize_query()->get_wp_query()->have_posts()) {
    $context['products'] = Timber::get_posts($products->query->posts);
}

$templates = [
    Template::viewTwigFile("single/{$post->post_type}/{$post->slug}"),
    Template::viewTwigFile("single/{$post->post_type}"),
    Template::viewTwigFile('single'),
    Template::viewTwigFile('index'),
];

Timber::render(
    apply_filters('wijnen/view-composer/single-streek/templates', $templates),
    apply_filters('wijnen/view-composer/single-streek/context', $context)
);
