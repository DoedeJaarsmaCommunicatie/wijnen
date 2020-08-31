<?php
namespace App;

use App\Providers\AjaxServiceProvider;
use App\Providers\MenuServiceProvider;
use App\Providers\HookServiceProvider;
use App\Providers\RestServiceProvider;
use App\Providers\CarbonServiceProvider;
use App\Providers\AssetsServiceProvider;
use App\Providers\UpdateServiceProvider;
use App\Providers\ContentServiceProvider;
use App\Providers\FunctionServiceProvider;
use App\Providers\ElementorServiceProvider;
use App\Providers\ShortcodeServiceProvider;
use App\Providers\CustomizerServiceProvider;

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
        ShortcodeServiceProvider::class,
        ElementorServiceProvider::class,
        CarbonServiceProvider::class,
        UpdateServiceProvider::class,
    ]
];
