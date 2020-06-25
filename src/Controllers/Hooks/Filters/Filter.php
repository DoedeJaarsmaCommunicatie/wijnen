<?php

namespace App\Controllers\Hooks\Filters;

abstract class Filter
{
    abstract public function filter();

    abstract public function hook();

    public function priority(): int
    {
        return 10;
    }

    public function parameterCount(): int
    {
        return 1;
    }
}
