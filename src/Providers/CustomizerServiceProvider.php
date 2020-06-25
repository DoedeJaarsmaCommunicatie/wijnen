<?php

namespace App\Providers;

use App\Bootstrap\Container;
use App\Controllers\Customizer\Customize;
use App\Controllers\Customizer\Footer\FooterCustomizer;

class CustomizerServiceProvider extends ServiceProvider
{
    public const CUS_CONF_ID = 'WIJNEN';

    protected static $customizer_panel_cache = [];

    protected $customizer_calls = [];


    public function boot(): void
    {
        $this->customizer_calls = apply_filters('wijnen/providers/customizer', [
            FooterCustomizer::class
        ]);

        \Kirki::add_config(static::CUS_CONF_ID, [
            'capability'    => 'edit_theme_options',
            'option_type'   => 'theme_mod',
        ]);
    }

    public function register(): void
    {
        foreach ($this->customizer_calls as $customizerCall) {
            if (class_exists($customizerCall) && is_subclass_of($customizerCall, Customize::class)) {
                /** @var Customize $container */
                $container = Container::get($customizerCall);

                if (!isset(static::$customizer_panel_cache[$container::$panel_name])) {
                    $container->registerPanel();
                    static::$customizer_panel_cache[$container::$panel_name] = [];
                }

                if (!isset(static::$customizer_panel_cache[$container::$panel_name]['section_name'])) {
                    $container->registerSection();
                    static::$customizer_panel_cache[$container::$panel_name]['section_name'] = $container::$panel_name;
                }

                $container->register();
            }
        }
    }
}
