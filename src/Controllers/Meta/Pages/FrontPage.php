<?php

namespace App\Controllers\Meta\Pages;

use Carbon_Fields\Container;
use App\Controllers\Meta\Field;

class FrontPage implements Field
{
    public function register()
    {
        Container::make('post_meta', 'Pagina instellingen')
            ->where('post_type', '=', 'page')
            ->where('post_id', '=', get_option('page_on_front'))
            ->add_tab('Hero Image', $this->getBannerFields());
    }

    protected function getBannerFields()
    {
        $fields = [];

        $fields [] = \Carbon_Fields\Field\Field::make('image', 'hero_img_mobile', 'Mobiel');
        $fields [] = \Carbon_Fields\Field\Field::make('image', 'hero_img_desktop', 'Desktop');
        $fields [] = \Carbon_Fields\Field\Field::make('text', 'hero_img_url', 'URL');

        return $fields;
    }
}
