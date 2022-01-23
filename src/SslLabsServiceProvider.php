<?php

namespace AdrianMejias\SslLabs;

use Illuminate\Support\ServiceProvider;

/**
 * SSL Labs Service Provider
 *
 * @package AdrianMejias\SslLabs
 */
class SslLabsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ssllabs.php' => config_path('ssllabs.php'),
            ], 'ssllabs');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ssllabs.php', 'ssllabs');

        $this->app->bind('ssllabs', fn ($app) => new SslLabsWrapper());
        $this->app->singleton(SslLabsWrapper::class);
        $this->app->alias(SslLabsWrapper::class, 'ssllabs');
    }
}
