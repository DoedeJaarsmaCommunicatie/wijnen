<?php
namespace App;

use App\Bootstrap\Container;
use App\Providers\AppServiceProvider;

//To use the environment uncomment this.
//Container::get(\App\Bootstrap\Env::class);

Container::get(AppServiceProvider::class);
