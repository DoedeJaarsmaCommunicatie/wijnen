<?php


namespace App\Controllers\Meta\Pages;


use Carbon_Fields\Container;
use App\Controllers\Meta\Field;

class WinePostTypePages implements Field
{
    public function register()
    {
        return Container::make('post_meta', 'Producent instellingen')
            ->where('post_type', '=', 'producent')
            ->where('post_type', '=', 'druif')
            ->where('post_type', '=', 'streek')
            ->add_tab('Type informatie', $this->getGeneralDataFields());
    }

    protected function getGeneralDataFields()
    {
        return [
            \Carbon_Fields\Field::make('rich_text', 'intro', 'Introductie'),
        ];
    }

}
