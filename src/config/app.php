<?php
namespace App;

use App\Providers\{
	MenuServiceProvider,
	FunctionServiceProvider,
	HookServiceProvider,
	AssetsServiceProvider
};

return [
	'providers'     => [
	    MenuServiceProvider::class,
		FunctionServiceProvider::class,
		HookServiceProvider::class,
		AssetsServiceProvider::class,
    ]
];
