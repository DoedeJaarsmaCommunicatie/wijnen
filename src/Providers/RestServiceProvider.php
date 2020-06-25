<?php


namespace App\Providers;

use App\Controllers\Http\Api\ApiManager;
use App\Controllers\Http\Api\v1\Shop\GetProductData;
use App\Controllers\Http\Api\v1\Shop\GetRelatedProducts;
use App\Controllers\Http\Api\v1\MailChimp\AddNewSubscriber;

class RestServiceProvider extends ServiceProvider
{
    protected $restClasses = [];

    public function boot()
    {
        $this->restClasses = apply_filters('wijnen/providers/rest', []);
    }

    public function register()
    {
        foreach ($this->restClasses as $restClass) {
            ApiManager::load($restClass);
        }
    }
}
