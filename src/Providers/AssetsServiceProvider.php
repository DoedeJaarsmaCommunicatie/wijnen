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

        WP::addStyle(
            'tiny-slider',
            'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css',
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
    }

    public function register()
    {
        add_action('wp_enqueue_scripts', [$this, 'dequeueAssets'], PHP_INT_MAX);
        add_action('elementor/frontend/after_register_scripts', [$this, 'deregister_elementor_scripts'], PHP_INT_MAX);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'deregister_elementor_styles'], PHP_INT_MAX);
        add_action('wp_footer', [$this, 'handleFooterAssets'], PHP_INT_MAX);
        WP::enqueue();
    }

    public function dequeueAssets(): void
    {
        WP::removeStyle('wc-block-style');
        WP::removeStyle('wp-block-library');
        WP::removeStyle('elementor-icons');

        if (is_product()) {
            WP::removeScript('casa-lever');
            WP::removeScript('casa-variable-prods');
            WP::removeStyle('casa-lever');
            WP::removeStyle('casa-variable-prods');
            WP::removeScript('jquery');
            wp_dequeue_style('elementor-pro');
            wp_dequeue_style('elementor-global');
            wp_deregister_script('jquery-swiper');
            wp_deregister_script('mailchimp-woocommerce');
            wp_enqueue_script(
                'updated-jquery',
                'https://code.jquery.com/jquery-3.5.1.min.js',
                [],
                '3.5.1',
                true
            );
        }

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

        if (!is_admin_bar_showing()) {
            WP::removeStyle('dashicons');
        }
    }

    public function handleFooterAssets()
    {
        if (is_product()) {
            wp_deregister_script('elementor-pro-frontend');
        }
    }

    public function deregister_elementor_scripts()
    {
        if (is_product()) {
            wp_deregister_script('elementor-frontend');
            wp_deregister_script('jquery-swiper');
            wp_deregister_script('elementor-sticky');
        }
    }

    public function deregister_elementor_styles()
    {
        if (is_product()) {
            wp_dequeue_style('elementor-frontend');
        }

        wp_deregister_style('elementor-icons-fa-solid');
        wp_deregister_style('elementor-icons-fa-regular');
        wp_deregister_style('elementor-icons-fa-brands');
    }
}
