<?php

namespace App\Controllers\Elementor\Widgets;

class SingleProductHorizontal extends SingleProductVertical
{
    protected $template = [
        'partials/tease/product-large-hor.html.twig'
    ];

    public function get_name()
    {
        return 'wineclub-horizontal-products';
    }

    public function get_title()
    {
        return 'Horizontale producten';
    }

    protected function getWrapperClass()
    {
        return implode(' ', [
            'horizontal-products',
            'products-large',
        ]);
    }
}
