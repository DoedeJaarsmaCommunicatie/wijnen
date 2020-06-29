<?php

namespace App\Providers;

use Twig\Environment;
use Twig\TwigFunction;
use App\Bootstrap\Container;
use App\Controllers\Functions\General\Carbon;
use App\Controllers\Functions\General\BottleImages;
use App\Controllers\Functions\WooCommerce\WooCommerceGeneral;

class FunctionServiceProvider extends ServiceProvider
{
	/**
	 * @var callable[]
	 */
    protected $functions = [];

    public function boot(): void
    {
        $this->functions = apply_filters('wijnen/providers/functions', [
        	'theme_option' => 'carbon_get_theme_option',
	        'get_store_url' => [WooCommerceGeneral::class, 'getShopUrl'],
	        'get_cart_url' => [WooCommerceGeneral::class, 'getCartUrl'],
	        'get_account_url' => [WooCommerceGeneral::class, 'getAccountUrl'],
	        'get_bottle_img' => [BottleImages::class, 'getBottleUrl'],
	        'get_theme_option' => [Carbon::class, 'get_theme_option'],
	        'get_wine_of_the_month' => [Carbon::class, 'get_wine_of_the_month'],
	        'get_custom_page_url' => [Carbon::class, 'get_custom_page'],
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
			        $twig->addFunction(new TwigFunction($name, $function));
		        } catch (\Throwable $e) {
			        // Do nothing. Class not found.
		        }
	        }

        }

        return $twig;
    }
}
