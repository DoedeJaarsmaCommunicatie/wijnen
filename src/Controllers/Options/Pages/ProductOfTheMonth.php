<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\{Field, Container};
use App\Controllers\Options\Option;
use App\Controllers\Options\NoCustomParent;

class ProductOfTheMonth implements Option
{
	use NoCustomParent;

	public function register ()
	{
		return Container::make('theme_options', 'Wijn van de maand')
			->add_fields($this->fields());
	}


	protected function fields(): array
	{
		$fields = [];
		$fields []= Field::make('association', 'red_wine_otm', 'Rode wijn van de maand')
			->set_max(1)
			->set_types([
				[
					'type' => 'post',
					'post_type' => 'product',
				]
			]);

		$fields []= Field::make('association', 'white_wine_otm', 'Witte wijn van de maand')
			->set_max(1)
			->set_types([
				[
					'type' => 'post',
					'post_type' => 'product',
				],
			]);

		return $fields;
	}
}
