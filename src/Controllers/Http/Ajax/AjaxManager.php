<?php
declare(strict_types=1);

namespace App\Controllers\Http\Ajax;

use App\Bootstrap\Container;

class AjaxManager
{
	/**
	 * @param string $class The classFQN to load
	 *
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public static function load(string $class)
	{
		/** @var AjaxInterface $class */
		$class = Container::get($class);

		add_action('wp_ajax_' . $class->actionName(), [$class, $class->hookName()]);
		if (!$class->isPrivate()) {
			add_action('wp_ajax_nopriv_' . $class->actionName(), [$class, $class->hookName()]);
		}
	}
}
