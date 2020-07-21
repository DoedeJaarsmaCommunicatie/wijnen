<?php

namespace App\Controllers\Elementor\Widgets;

use App\Post;
use Timber\Timber;
use App\Models\Product;
use Elementor\Controls_Stack;
use Elementor\Controls_Manager;
use DusanKasan\Knapsack\Collection;
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
		        $this->renderSingleProduct($settings['query_posts_ids']);
        		return;
	        }

        	$this->renderWrapperStart();
	            foreach ($settings['query_posts_ids'] as $postsId) {
	            	$this->renderSingleProduct($postsId);
	            }

	            if ($settings['button_link'] && $settings['button_text']) {
		            $this->renderButton($settings);
	            }
		    $this->renderWrapperEnd();
            return;
        }

      $this->renderWrapperStart();
	    if (empty($settings['query_include'])) {
	      foreach ($this->getLatestProducts($settings) as $product) {
		      $this->renderSingleProduct($product->get_id());
	      }
      } else {
	      foreach ($this->getProductsFromQuery($settings) as $product) {
		      $this->renderSingleProduct($product->get_id());
	      }
      }

	    $this->renderButton($settings);
	    $this->renderWrapperEnd();
    }

	protected function getProductsFromQuery(array $settings)
	{
		$limit = ($settings['rows']?? 1) * ($settings['columns']?? 1);
		$includes = array_map(static function ($id) { return (int) $id; }, $settings['query_include_term_ids']);
		$query = new \WC_Product_Query([
			'limit' => $limit,
			'category' => $includes,
		]);

		return $query->get_products();
    }

    protected function getLatestProducts(array $settings)
    {
      $limit = ($settings['rows']?? 1) * ($settings['columns']?? 1);
      $query = new \WC_Product_Query([
          'limit' => $limit,
      ]);

      return $query->get_products();
    }

    protected function renderWrapperStart(): void
    {
	    print "<section class='{$this->getWrapperClass()}'>";
    }

	protected function renderWrapperEnd(): void
	{
		print '</section>';
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

	protected function renderButton(array $data): void
	{
		?>
		<a href="<?= $data['button_link']['url']?? '#' ?>>" class="products-large-cta">
			<h3><?= $data['button_text']?? '' ?></h3>
			<i class="fas fa-chevron-right"></i>
		</a>
	<?php
    }
}
