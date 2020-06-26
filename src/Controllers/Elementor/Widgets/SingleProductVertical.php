<?php

namespace App\Controllers\Elementor\Widgets;

use App\Post;
use Timber\Timber;
use App\Models\Product;
use Elementor\Controls_Stack;
use Elementor\Controls_Manager;
use ElementorPro\Modules\Woocommerce\Widgets\Products;
use ElementorPro\Modules\Woocommerce\Classes\Products_Renderer;

class SingleProductVertical extends Products
{
    protected $template = [
        'partials/tease/product-large.html.twig',
    ];

    public function get_name()
    {
        return 'wineclub-vertical-products';
    }

    public function get_title()
    {
        return 'Verticale producten';
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'special',
            [
                'label' => 'Label text',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->register_query_controls();
    }

    protected function render()
    {
        if (WC()->session) {
            wc_print_notices();
        }

        if (!isset($GLOBALS['post'])) {
            $GLOBALS['post'] = null;
        }

        $settings = $this->get_settings();

        if (empty($settings['query_posts_ids'])) {
            // Maybe add query to support more types of products
            return;
        }

        $id = (int) $settings['query_posts_ids'][0];

        $post = new Product($id);
        $post->{'special'} = $settings['special'] ?? false;
        $context = [];
        $context['product'] = $post;

//        print Timber::compile($this->template, $context);
    }
}
