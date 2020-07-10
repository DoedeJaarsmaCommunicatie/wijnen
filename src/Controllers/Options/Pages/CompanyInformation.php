<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\Field;
use Carbon_Fields\Container;
use App\Controllers\Options\Option;
use App\Controllers\Options\Traits\InAdminBar;
use App\Controllers\Options\Traits\NoCustomParent;

class CompanyInformation implements Option
{
	use NoCustomParent;
	use InAdminBar;

	public function register()
	{
		return Container::make('theme_options', 'Bedrijf informatie')
			->add_fields($this->fields());
	}

	protected function fields(): array
	{
		$fields = [];

		$fields []= Field::make('text', 'store_name', 'Bedrijfsnaam');
		$fields []= Field::make('rich_text', 'store_address', 'Adres');
		$fields []= Field::make('text', 'store_phone', 'Telefoonnummer');
		$fields []= Field::make('text', 'store_email', 'E-mail')
			->set_attribute('type', 'email');

		return $fields;
	}
}
