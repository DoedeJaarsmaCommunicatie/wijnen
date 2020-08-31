<?php

namespace App\Providers;

use App\Controllers\Shortcodes\ShortcodeManager;
use App\Controllers\Shortcodes\Products\FetchProductsOnTags;
use App\Controllers\Shortcodes\Products\FetchProductsOnAttributes;

class ShortcodeServiceProvider extends ServiceProvider
{
    protected $shortcodes;

    public function boot()
    {
        $this->shortcodes = apply_filters('wijnen/providers/shortcodes/register', [
            FetchProductsOnAttributes::class,
            FetchProductsOnTags::class,
        ]);
    }

    public function register()
    {
        foreach ($this->shortcodes as $shortcode) {
            try {
                ShortcodeManager::load($shortcode);
            } catch (\Throwable $e) {
                // Shortcode not found.
            }
        }
    }
}
