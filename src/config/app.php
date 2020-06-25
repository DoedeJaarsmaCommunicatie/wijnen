<?php
namespace App;

use App\Providers\{AjaxServiceProvider, ContentServiceProvider, CustomizerServiceProvider, ElementorServiceProvider, MenuServiceProvider, FunctionServiceProvider, HookServiceProvider, AssetsServiceProvider, RestServiceProvider};

return [
	'providers'     => [
	    MenuServiceProvider::class,
		ContentServiceProvider::class,
		FunctionServiceProvider::class,
		HookServiceProvider::class,
		AssetsServiceProvider::class,
		AjaxServiceProvider::class,
		CustomizerServiceProvider::class,
		RestServiceProvider::class,
		ElementorServiceProvider::class
    ]
];
