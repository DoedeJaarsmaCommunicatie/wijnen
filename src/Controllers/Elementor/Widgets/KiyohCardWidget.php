<?php

namespace App\Controllers\Elementor\Widgets;

use Elementor\Widget_Base;

class KiyohCardWidget extends Widget_Base
{
    public function get_name(): string
    {
        return 'kiyoh-card';
    }

    public function get_title(): string
    {
        return 'Kiyoh kaart';
    }

    protected function render()
    {
        // Immediately use the newer version. if it exists
        if (!class_exists('\cdk_model')) {
            return;
        }

        $context = \Timber\Timber::get_context();

        $context['kiyoh'] = (new \cdk_model())->get();

        print \Timber\Timber::compile('partials/blocks/kiyoh-card.html.twig', $context);
    }
}
