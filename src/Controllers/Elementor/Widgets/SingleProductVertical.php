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
    	parent::_register_controls();

        $this->start_controls_section(
            'button',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => 'Label text',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
        	'button_link',
	        [
	        	'label' => 'Link',
		        'type' => Controls_Manager::URL,
	        ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        if (WC()->session) {
            wc_print_notices();
        }

        if (!isset($GLOBALS['post'])) {
            $GLOBALS['post'] = null;
        }

        $settings = $this->get_settings();

	    if (!empty($settings['query_posts_ids'])) {
        	if (count($settings['query_posts_ids']) === 1) {
		        $this->renderSingleProduct(1);
        		return;
	        }

        	print "<section class='{$this->getWrapperClass()}'>";
	            foreach ($settings['query_posts_ids'] as $postsId) {
	            	$this->renderSingleProduct($postsId);
	            }

	            if ($settings['button_link'] && $settings['button_text']) {
	            	printf(
	            		'<a href="%s" class="products-large-cta"><h3>%s</h3> <i class="fas fa-chevron-right"></i></a>',
			            $settings['button_link']['url'],
			            $settings['button_text']
		            );
	            }
        	print '</section>';
            return;
        }

        // All specifically selected fields are rendered.
	    var_dump($settings);
    }

	protected function getWrapperClass () {
		return implode(' ', [
			'vertical-products',
			'products-large',
			'container',
			'mx-auto',
			'p-4',
			'lg:px-0',
		]);
    }

	protected function renderSingleProduct(int $product_id): void
	{
		$post = new Product($product_id);
		$context = Timber::get_context();
		$context['product'] = $post;

		Timber::render($this->template, $context);


    }
}
