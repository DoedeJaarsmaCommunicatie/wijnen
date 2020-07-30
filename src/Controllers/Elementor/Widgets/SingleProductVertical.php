<?php

namespace App\Controllers\Elementor\Widgets;

use Timber\Term;
use Timber\Timber;
use Timber\Helper;
use Timber\PostQuery;
use App\Models\Product;
use Elementor\Controls_Manager;
use App\Controllers\Functions\General\Carbon;
use ElementorPro\Modules\Woocommerce\Widgets\Products;

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

        $this->start_controls_section(
            'fotm',
            [
                'label' => 'Wijn van de maand',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_red_fotm',
            [
                'label' => 'Rode wijn van de maand tonen',
                'type' => Controls_Manager::SWITCHER
            ]
        );

        $this->add_control(
            'show_white_fotm',
            [
                'label' => 'Witte wijn van de maand tonen',
                'type' => Controls_Manager::SWITCHER
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
        $categories = array_map(static function ($id) {
            return Helper::transient("category_{$id}_name", static function () use ($id) {
                $term = new Term($id);

                if ($term->object_type === 'product_cat') {
                    return $term->name;
                }
            });
        }, $settings['query_include_term_ids']);

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $this->getProductLimits($settings),
            'limit' => $this->getProductLimits($settings),
            'category' => $categories,
            'tax_query' => [
                'relation' => 'OR',
                [
                    'taxonomy' => 'product_cat',
                    'terms' => $settings['query_include_term_ids'],
                ],
            ],
            'order' => $settings['query_order'],
            'orderby' => $settings['query_orderby']
        ];

        foreach (wc_get_attribute_taxonomies() as $attributeTaxonomy) {
            $args['tax_query'] [] = [
              'taxonomy' => 'pa_' . $attributeTaxonomy->attribute_name,
              'terms' => $settings['query_include_term_ids'],
            ];
        }

        $query = new PostQuery($args, Product::class);

        return $this->attachFlavorOfTheMonth($query->get_posts(), $settings);
    }

    protected function getLatestProducts(array $settings)
    {
        $query = new \WC_Product_Query([
            'limit' => $this->getProductLimits($settings),
            'order' => $settings['query_order'],
            'orderby' => $settings['query_orderby']
        ]);

        return $this->attachFlavorOfTheMonth($query->get_products(), $settings);
    }

    private function attachFlavorOfTheMonth(array $products, array $settings)
    {
        if ($settings['show_white_fotm'] === 'yes' && Carbon::get_wine_of_the_month('white')) {
            array_splice($products, 2, 1, [Carbon::get_wine_of_the_month('white')]);
        }

        if ($settings['show_red_fotm'] === 'yes' && Carbon::get_wine_of_the_month('red')) {
            array_splice($products, 3, 1, [Carbon::get_wine_of_the_month('red')]);
        }

        return $products;
    }

    private function getProductLimits(array $settings)
    {
        return ($settings['rows'] ?? 1) * ($settings['columns'] ?? 1);
    }

    protected function renderWrapperStart(): void
    {
        print "<section class='{$this->getWrapperClass()}'>";
    }

    protected function renderWrapperEnd(): void
    {
        print '</section>';
    }

    protected function getWrapperClass()
    {
        return implode(' ', [
            'vertical-products',
            'products-large',
            'container',
            'mx-auto',
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
        <a href="<?= $data['button_link']['url'] ?? '#' ?>" class="products-large-cta">
          <h3 style="display: inline-block;"><?= $data['button_text'] ?? '' ?></h3>
          <i class="fas fa-chevron-right"></i>
        </a>
        <?php
    }
}
