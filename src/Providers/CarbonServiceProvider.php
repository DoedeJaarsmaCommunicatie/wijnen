<?php

namespace App\Providers;

use App\Bootstrap\Container;
use App\Controllers\Meta\Field;
use Carbon_Fields\Carbon_Fields;
use App\Controllers\Meta\Pages\FrontPage;
use App\Controllers\Options\OptionManager;
use App\Controllers\Meta\Pages\WinePostTypePages;
use App\Controllers\Options\Pages\SpecialPages;
use App\Controllers\Options\Pages\FooterSettings;
use App\Controllers\Options\Pages\ProductOfTheMonth;
use App\Controllers\Options\Pages\ShortcodeSettings;
use App\Controllers\Options\Pages\CompanyInformation;

class CarbonServiceProvider extends ServiceProvider
{
    protected $fields = [];

    /**
     * @var string[] A string of classnames.
     */
    protected $options = [];

    public function __construct()
    {
        add_action('after_setup_theme', static function () {
            if (!Carbon_Fields::is_booted()) {
                Carbon_Fields::boot();
            }
        });

        parent::__construct();
    }

    public function boot(): void
    {
        $this->fields = apply_filters('wijnen/providers/fields', [
            FrontPage::class,
            WinePostTypePages::class
        ]);

        $this->options = apply_filters('wijnen/providers/options', [
            ProductOfTheMonth::class,
            CompanyInformation::class,
            SpecialPages::class,
            FooterSettings::class,
            ShortcodeSettings::class,
        ]);
    }

    public function register(): void
    {
        foreach ($this->fields as $field) {
            /** @var Field $field */
            try {
                $field = Container::get($field);
                add_action('carbon_fields_register_fields', [$field, 'register']);
            } catch (\Throwable $exception) {
                // Do nothing. Class not found and not registered
            }
        }

        foreach ($this->options as $option) {
            add_action('carbon_fields_register_fields', static function () use ($option) {
                OptionManager::register($option);
            });
        }
    }
}
