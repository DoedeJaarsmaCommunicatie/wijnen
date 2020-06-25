<?php

namespace App\Controllers\Http\Api;

use App\Bootstrap\Container;

class ApiManager
{
	public static function load(string $class)
	{
		/** @var RestController $class */
		$class = Container::get($class);

		add_action('rest_api_init', static function () use ($class) {
			register_rest_route(
				$class->getBaseNamespace(),
				$class->endpoint(),
				$class->methods()
			);
		}, 10);
	}
}
