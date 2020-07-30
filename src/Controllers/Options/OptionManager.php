<?php

namespace App\Controllers\Options;

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

class OptionManager
{
    /**
     * @var Container\Theme_Options_Container
     */
    public $basic_options;

    private function __construct()
    {
        $this->basic_options = Container::make('theme_options', 'Thema opties')
            ->add_fields([
                Field::make('header_scripts', 'header_scripts', __('Header Scripts')),
                Field::make('footer_scripts', 'footer_scripts', __('Footer Scripts'))
            ]);

        $this->addOptionsToAdminBar();
        add_action('wijnen/app/theme-options/register/parent', $this->basic_options);
    }

    /**
     * @var static|null
     */
    protected static $_instance = null;

    protected static function instantiate(): self
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    protected function addOptionsToAdminBar()
    {
        add_action('admin_bar_menu', function (\WP_Admin_Bar $admin_bar) {
            $admin_bar->add_menu([
                'id' => $this->basic_options->get_id(),
                'title' => $this->basic_options->title,
                'href' => \get_admin_url(get_current_blog_id(), 'admin.php?page=crb_' . $this->basic_options->get_id() . '.php'),
                'meta' => [
                    'title' => $this->basic_options->title,
                ]
            ]);
        }, 100);
    }

    public static function instance(): self
    {
        return static::instantiate();
    }

    public static function register(string $class)
    {
        $self = static::instantiate();

        try {
            /** @var Option $option */
            $option = \App\Bootstrap\Container::get($class);
            do_action('wijnen/app/theme-options/register/' . (new \ReflectionClass($option))->getShortName());
        } catch (\Throwable $exception) {
            // Do nothing option not found. Silently die.
            return;
        }

        $container = $option->register();
        $container->set_page_parent($option->custom_parent()?: $self->basic_options);

        if ($option->in_admin_bar()) {
            add_action('admin_bar_menu', function (\WP_Admin_Bar $admin_bar) use ($container, $self) {
                $admin_bar->add_menu([
                    'id' => $container->get_id(),
                    'title' => $container->title,
                    'parent' => $self->basic_options->get_id(),
                    'href' => \get_admin_url(get_current_blog_id(), 'admin.php?page=crb_' . $container->get_id() . '.php'),
                    'meta' => [
                        'title' => $container->title,
                    ]
                ]);
            }, 101);
        }
    }
}
