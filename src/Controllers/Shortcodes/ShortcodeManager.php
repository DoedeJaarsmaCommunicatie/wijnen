<?php

namespace App\Controllers\Shortcodes;

use App\Bootstrap\Container;

class ShortcodeManager
{
    public static function load(string $class)
    {
        /** @var ShortcodeController $class */
        $class = Container::get($class);

        add_shortcode(
            $class->getTag(),
            [$class, 'callback']
        );
    }
}
