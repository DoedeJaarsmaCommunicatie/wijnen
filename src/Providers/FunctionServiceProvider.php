<?php

namespace App\Providers;

use Twig\Environment;
use Twig\TwigFunction;
use App\Bootstrap\Container;
use App\Controllers\Functions\ThemeOptions;

class FunctionServiceProvider extends ServiceProvider
{
    protected $functions = [];

    public function boot(): void
    {
        $this->functions = apply_filters('wijnen/providers/functions', [
        	'theme_option' => 'carbon_get_theme_option',
        ]);

        add_filter('timber/twig', [$this, 'registerFunctions']);
    }

    /**
     * @param Environment $twig
     *
     * @return Environment
     */
    public function registerFunctions(Environment $twig): Environment
    {
        foreach ($this->functions as $name => $function) {
        	if (is_string($function)) {
        		$twig->addFunction(new TwigFunction($name, $function));
	        } else {
		        try {
			        $class = Container::get($function);
			        $twig->addFunction(new TwigFunction($name, [$class, 'callback']));
		        } catch (\Throwable $e) {
			        // Do nothing. Class not found.
		        }
	        }

        }

        return $twig;
    }
}
