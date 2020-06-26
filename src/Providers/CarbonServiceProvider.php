<?php

namespace App\Providers;

use App\Bootstrap\Container;
use App\Controllers\Meta\Field;
use Carbon_Fields\Carbon_Fields;
use App\Controllers\Meta\Pages\FrontPage;

class CarbonServiceProvider extends ServiceProvider
{
	protected $fields = [];

	public function __construct () {
		parent::__construct();

		add_action('after_setup_theme', static function () {
			if (!Carbon_Fields::is_booted()) {
				Carbon_Fields::boot();
			}
		});
	}

	public function boot()
	{
		$this->fields = apply_filters('wijnen/providers/fields', [
			FrontPage::class
		]);

		foreach ($this->fields as $field) {
			/** @var Field $field */
			$field = Container::get($field);
			add_action('carbon_fields_register_fields', [$field, 'register']);
		}
	}
}
