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
	    WP::removeStyle('wc-block-style');
	    WP::removeStyle('wp-block-library');

	    if (is_product() || !(is_cart() || is_checkout() || is_woocommerce() || is_account_page())) {
		    WP::removeStyle('woocommerce_frontend_styles');
		    WP::removeStyle('woocommerce-general');
		    WP::removeStyle('woocommerce-layout');
		    WP::removeStyle('woocommerce-smallscreen');
		    WP::removeStyle('woocommerce_prettyPhoto_css');

		    WP::removeStyle('wooajaxcart');
		    WP::removeStyle('wcpf-plugin-style');
		    WP::removeStyle('wpgdprc.css');

		    WP::removeScript('selectWoo');
		    WP::removeScript('wc-add-payment-method');
		    WP::removeScript('wc_price_slider');
		    WP::removeScript('wc-single-product');
		    WP::removeScript('wc-credit-card-form');
		    WP::removeScript('wc-chosen');
		    WP::removeScript('wc-cart');
		    WP::removeScript('jqueryui');
		    WP::removeScript('fancybox');
		    WP::removeScript('prettyPhoto');
		    WP::removeScript('prettyPhoto-init');
		    WP::removeScript('woocommerce');
		    WP::removeScript('jquery-blockui');
		    WP::removeScript('jquery-placeholder');
		    WP::removeScript('jquery-payment');

		    WP::removeScript('wcpf-plugin-polyfills-script');
		    WP::removeScript('wcpf-plugin-vendor-script');
	    }
	    // Remove jQuery.
	    WP::removeScript('jquery');
	    WP::addScript('jquery', get_stylesheet_directory_uri() . '/dist/jquery.min.js', [], false, false);

        if (!is_admin_bar_showing()) {
            WP::removeStyle('dashicons');
        }
    }
}
