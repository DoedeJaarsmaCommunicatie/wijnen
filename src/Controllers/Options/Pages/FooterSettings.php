<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\Field\Field;
use App\Controllers\Options\Option;
use Carbon_Fields\Container\Container;
use App\Controllers\Options\Traits\InAdminBar;
use App\Controllers\Options\Traits\NoCustomParent;

class FooterSettings implements Option
{
	use NoCustomParent;
	use InAdminBar;

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
