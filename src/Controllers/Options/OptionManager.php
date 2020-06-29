<?php

namespace App\Controllers\Options;

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

class OptionManager
{
	/**
	 * @var Container\Theme_Options_Container
	 */
	public $basic_options;

	private function __construct()
	{
		$this->basic_options = Container::make('theme_options', 'Thema opties')
			->add_fields([
				Field::make('header_scripts', 'header_scripts', __('Header Scripts')),
				Field::make('footer_scripts', 'footer_scripts', __('Footer Scripts'))
			]);

		add_action('wijnen/app/theme-options/register/parent', $this->basic_options);
	}

	/**
	 * @var static|null
	 */
	protected static $_instance = null;

	protected static function instantiate(): self
	{
		if (null === static::$_instance) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}

	public static function instance(): self
	{
		return static::instantiate();
	}

	public static function register(string $class)
	{
		$self = static::instantiate();

		try {
			/** @var Option $option */
			$option = \App\Bootstrap\Container::get($class);
			do_action('wijnen/app/theme-options/register/' . (new \ReflectionClass($option))->getShortName());
		} catch (\Throwable $exception) {
			// Do nothing option not found. Silently die.
			return;
		}

		$option->register()
		       ->set_page_parent($option->custom_parent()?: $self->basic_options);
	}
}
