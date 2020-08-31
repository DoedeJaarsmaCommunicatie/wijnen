<?php


namespace App\Controllers\Shortcodes\Products;


use Timber\Timber;
use App\Models\Product;
use App\Helpers\Template;
use Elderbraum\CasaProductFactory\ProductsFactory;
use Elderbraum\CasaProductFactory\Products\Newest;
use App\Controllers\Shortcodes\ShortcodeController;

class FetchProductsOnAttributes extends ShortcodeController
{
    protected $defaultAttributes = [
        'attribute' => '',
        'terms' => '',
    ];

    public function getTag(): string
    {
        return 'product-on-attributes';
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
                                       'taxonomy' => $attributes['attribute'],
                                       'field'    => 'slug',
                                       'terms'    => explode(',', $attributes['terms'])
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
            'wijnen/shortcodes/products/on-attribute',
            $context['products'],
            $attributes['attribute'],
            $attributes['terms']
        );

        $templates = [
            Template::partialHtmlTwigFile('blocks/products-horizontal-list')
        ];

        return Timber::compile($templates, $context);
    }
}
