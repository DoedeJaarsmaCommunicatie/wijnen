<?php

namespace App\Controllers\Elementor\Widgets;

use Timber\Timber;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ProductButtonCard extends Widget_Base
{
    public function get_name(): string
    {
        return 'product-button';
    }

    public function get_title(): string
    {
        return 'Product button';
    }

    protected function _register_controls(): void
    {
        $this->start_controls_section(
            'content',
            [
                'label' => __('My Section', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'Knop tekst',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'Pagina url',
                'type' => Controls_Manager::URL,
                'show_external' => false,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings();
        if (!isset($settings['title'], $settings['link'])) {
            return;
        }

        print Timber::compile_string("
		        <a href='{{ link }}' class='products-large-cta'>
            <h3>{{ title }} <i class='fas fa-chevron-right'></i></h3>
        </a>", [ 'title' => $settings['title'], 'link' => $settings['link']['url'] ]);
    }
}
