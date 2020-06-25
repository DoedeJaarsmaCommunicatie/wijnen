<?php

namespace App\Providers;

use App\Helpers\WP;
use App\Controllers\TwigFunctions\AdminHelpers;

class AssetsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        WP::addStyle(
            'main-style',
            WP::getAssetLocation(['dist', 'styles', 'main.css']),
            [],
            filemtime(WP::getAssetLocation('dist/styles/main.css', false))
        );

        WP::addScript(
            'main-manifest',
            WP::getAssetLocation(['dist', 'scripts', 'manifest.js']),
            [],
            filemtime(WP::getAssetLocation(['dist','scripts', 'manifest.js'], false))
        );

        WP::addScript(
            'main-vendor',
            WP::getAssetLocation(['dist', 'scripts', 'vendor.js']),
            ['main-manifest'],
            filemtime(WP::getAssetLocation(['dist', 'scripts', 'vendor.js'], false))
        );

        WP::addScript(
            'main-script',
            WP::getAssetLocation(['dist', 'scripts', 'main.js']),
            ['main-manifest', 'main-vendor'],
            filemtime(WP::getAssetLocation('dist/scripts/main.js', false))
        );

        /*
         * Uncomment this block to add styles to the admin area of wordpress.
         */
//        WP::addAdminStyle(
//            'main-admin',
//            WP::getAssetLocation('dist/styles/admin.css'),
//            [],
//            filemtime(WP::getAssetLocation('dist/styles/admin.css', false))
//        );

        WP::addScript(
            'updated-jquery',
            'https://code.jquery.com/jquery-3.5.1.min.js',
            [],
            '3.5.1',
            false
        );
    }

    public function register()
    {
        WP::enqueue();

        add_action('wp_enqueue_scripts', [$this, 'dequeueAssets'], 20);
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    }

    public function dequeueAssets(): void
    {
        if (!is_admin() || !is_cart() || !is_checkout()) {
//            WP::removeScript('jquery');
            WP::removeScript('wp-embed');
            WP::removeScript('hoverintent-js');
        }

        if (!is_admin_bar_showing()) {
            WP::removeStyle('dashicons');
        }

        WP::removeStyle('wp-block-library');
        WP::removeStyle('wc-block-style');
    }
}
