<?php

namespace App\Controllers\Hooks\Filters;

abstract class Filter
{

    /**
     * The filter function called on the hook described in hook function.
     *
     * @return mixed
     * @see Filter::hook()
     */
    abstract public function filter();

    /**
     * The hook where to attach the filter function on.
     *
     * @return string
     * @see Filter::filter()
     */
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
