<?php

namespace App\Providers;

use App\Controllers\Http\Ajax\AjaxManager;
use App\Controllers\Http\Ajax\v1\Shop\AddItemToCart;
use App\Controllers\Http\Ajax\v1\Common\SearchResults;
use App\Controllers\Http\Ajax\v1\Favorites\CurrentUserList;
use App\Controllers\Http\Ajax\v1\Favorites\CurrentUserCount;

class AjaxServiceProvider extends ServiceProvider
{
    protected $ajaxClasses = [];

    public function boot()
    {
        $this->ajaxClasses = apply_filters('wijnen/providers/ajax', [
            SearchResults::class,
            AddItemToCart::class,
            CurrentUserCount::class,
            CurrentUserList::class,
        ]);
    }

    public function register()
    {
        foreach ($this->ajaxClasses as $ajaxClass) {
            AjaxManager::load($ajaxClass);
        }
    }
}
