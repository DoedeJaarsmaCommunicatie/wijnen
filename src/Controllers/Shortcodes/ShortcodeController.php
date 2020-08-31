<?php

namespace App\Controllers\Shortcodes;

abstract class ShortcodeController implements Shortcode
{
    /**
     * @var array
     */
    protected $defaultAttributes = [];

    /**
     * @param $attributes
     *
     * @return array
     */
    protected function getAttributes($attributes): array
    {
        return shortcode_atts($this->defaultAttributes, $attributes);
    }
}
