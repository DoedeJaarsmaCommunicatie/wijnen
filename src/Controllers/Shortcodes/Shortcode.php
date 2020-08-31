<?php

namespace App\Controllers\Shortcodes;

interface Shortcode
{
    public function getTag(): string;

    public function callback();
}
