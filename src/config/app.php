<?php
namespace App;

use App\Providers\{AjaxServiceProvider, CarbonServiceProvider, ContentServiceProvider, CustomizerServiceProvider, ElementorServiceProvider, MenuServiceProvider, FunctionServiceProvider, HookServiceProvider, AssetsServiceProvider, RestServiceProvider, UpdateServiceProvider};

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
		ElementorServiceProvider::class,
		CarbonServiceProvider::class,
		UpdateServiceProvider::class,
    ]
];
