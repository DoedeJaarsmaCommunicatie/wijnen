<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\Field\Field;
use App\Controllers\Options\Option;
use Carbon_Fields\Container\Container;

class FooterSettings implements Option
{
	public function custom_parent ()
	{
		return false;
	}

	public function register ()
	{
		return Container::make('theme_options', 'Footer')
			->add_fields($this->fields());

	}

	protected function fields():array
	{
		$fields = [];
		$fields []= Field::make('rich_text', 'footer_country_lists');
		$fields []= Field::make('rich_text', 'footer_domains_list');
		$fields []= Field::make('rich_text', 'footer_grapes_list');
		$fields []= Field::make('rich_text', 'footer_regions_list');

		return $fields;
	}
}
