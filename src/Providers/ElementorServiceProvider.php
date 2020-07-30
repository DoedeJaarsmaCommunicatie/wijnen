<?php

namespace App\Providers;

use Elementor\Plugin;
use App\Controllers\Elementor\Widgets\KiyohCardWidget;
use App\Controllers\Elementor\Widgets\ProductButtonCard;
use App\Controllers\Elementor\Widgets\SingleProductVertical;
use App\Controllers\Elementor\Widgets\SingleProductHorizontal;

class ElementorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action('elementor/widgets/widgets_registered', [$this, 'registerWidgets']);
    }

    public function registerWidgets()
    {
        Plugin::instance()->widgets_manager->register_widget_type(new SingleProductVertical());
        Plugin::instance()->widgets_manager->register_widget_type(new SingleProductHorizontal());
        Plugin::instance()->widgets_manager->register_widget_type(new KiyohCardWidget());
        Plugin::instance()->widgets_manager->register_widget_type(new ProductButtonCard());
    }
}
