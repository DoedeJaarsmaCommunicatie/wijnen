<?php
namespace App\Providers;

use App\Helpers\Log;
use App\Bootstrap\Container;

class AppServiceProvider extends ServiceProvider
{
    protected $providers;

    public function boot(): void
    {
        $providers = include get_stylesheet_directory() . '/src/config/app.php';
        $this->providers = apply_filters('wijnen/app/register-providers/providers', $providers['providers']);
        do_action('wijnen/app/init');
    }

    public function register(): void
    {
        foreach ($this->providers as $provider) {
            try {
                do_action('wijnen/app/register-options/' . (new \ReflectionClass($provider))->getShortName());
            } catch (\ReflectionException $exception) {
                Log::warning('Reflection error while registering providers', ['class' => $provider]);
            }

            try {
                Container::get($provider);
            } catch (\Throwable $exception) {
                // Do nothing. Class not found so it wont be registered
            }
        }

        do_action('wijnen/app/providers/initialized');
    }
}
