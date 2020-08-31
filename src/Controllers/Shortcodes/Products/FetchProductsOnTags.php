<?php

namespace App\Controllers\Shortcodes\Products;

use Timber\Timber;
use App\Models\Product;
use App\Helpers\Template;
use Elderbraum\CasaProductFactory\Products\Newest;
use Elderbraum\CasaProductFactory\ProductsFactory;
use App\Controllers\Shortcodes\ShortcodeController;

class FetchProductsOnTags extends ShortcodeController
{
    protected $defaultAttributes = [
        'tags' => '',
    ];

    public function getTag(): string
    {
        return 'product-on-tags';
    }

    public function callback($attributes = [])
    {
        $attributes = $this->getAttributes($attributes);

        /** @var Newest $productsLoader */
        $productsLoader = ProductsFactory::create(Newest::class);

        $productsLoader->boot()
            ->add_args(
                [
                    'tax_query' => [
                        'relation' => 'OR',
                        [
                            'taxonomy' => 'product_tag',
                            'field'    => 'slug',
                            'terms'    => explode(',', $attributes['tags'])
                        ]
                    ]
                ]
            );

        if (!$productsLoader->initialize_query()->get_wp_query()->have_posts()) {
            return '';
        }

        $context             = Timber::get_context();
        $context['products'] = Timber::get_posts($productsLoader->get_wp_query()->posts, Product::class);
        $context['products'] = apply_filters(
            'wijnen/shortcodes/products/on-tag',
            $context['products'],
            $attributes['tags']
        );

        $templates = [
            Template::partialHtmlTwigFile('blocks/products-horizontal-list')
        ];

        return Timber::compile($templates, $context);
    }
}
