<?php

namespace Wpdew\HelperPack;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

class LaravelWpdewServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $source = __DIR__.'/config/wpdew.php';
        
        $this->publishes([
            $source => config_path('wpdew.php')
        ], 'config');

        //$this->mergeConfigFrom($source, 'wpdew');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Analytics::class, 'wpdew'];
    }
}