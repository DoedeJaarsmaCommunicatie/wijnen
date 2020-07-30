<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\Field;
use Carbon_Fields\Container;
use App\Controllers\Options\Option;
use App\Controllers\Options\Traits\NotInAdminBar;
use App\Controllers\Options\Traits\NoCustomParent;

class ShortcodeSettings implements Option
{
    use NoCustomParent;
    use NotInAdminBar;

    public function register()
    {
        return Container::make('theme_options', 'Shortcode instellingen')
            ->add_fields($this->fields());
    }

    protected function fields(): array
    {
        return [
            Field::make('text', 'shortcode_product-archive_filter', 'Product archive Filter'),
            Field::make('text', 'shortcode_product-archive_breadcrumbs', 'Product archive Breadcrumbs')
        ];
    }
}
