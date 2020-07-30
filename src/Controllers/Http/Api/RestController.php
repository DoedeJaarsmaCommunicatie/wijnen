<?php

namespace App\Controllers\Http\Api;

use App\Controllers\Http\Controller;

abstract class RestController extends Controller implements RestInterface
{
    public function baseUrl(): string
    {
        return 'wijnen';
    }

    public function version(): string
    {
        return 'v1';
    }

    public function getBaseNamespace(): string
    {
        return $this->baseUrl() . '/' . $this->version();
    }
}
