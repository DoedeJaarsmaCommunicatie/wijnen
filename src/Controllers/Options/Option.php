<?php

namespace App\Controllers\Options;

use Carbon_Fields\Container\Theme_Options_Container;

interface Option
{
	/**
	 * @return string|false
	 */
	public function custom_parent();

	/**
	 * @return Theme_Options_Container
	 */
	public function register();
}
