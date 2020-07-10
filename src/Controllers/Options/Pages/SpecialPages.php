<?php

namespace App\Controllers\Options\Pages;

use Carbon_Fields\Field;
use Carbon_Fields\Container;
use App\Controllers\Options\Option;
use App\Controllers\Options\Traits\InAdminBar;
use App\Controllers\Options\Traits\NoCustomParent;

class SpecialPages implements Option
{
	use NoCustomParent;
	use InAdminBar;

	public function register ()
	{
		return Container::make('theme_options', 'Link informatie')
			->add_fields($this->fields());
	}

	protected function fields(): array
	{
		$fields = [];
		$fields []= Field::make_association('contact_page', 'Contact')
			->set_max(1)
			->set_types([
				[
					'type' => 'post',
					'post_type' => 'page'
				],
			]);

		return $fields;
	}

}
