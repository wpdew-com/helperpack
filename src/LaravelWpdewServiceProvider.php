<?php

namespace Wpdew\HelperPack;

use Illuminate\Support\ServiceProvider;
use TheIconic\Tracking\GoogleAnalytics\Analytics;

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
        $this->app->bind(Analytics::class, function ($app) {
            $config = $app['config'];

            $analytics = new Analytics($config->get('gamp.is_ssl', false), $config->get('gamp.is_disabled', false));

            $analytics->setProtocolVersion($config->get('gamp.protocol_version', 1))
                ->setTrackingId($config->get('gamp.tracking_id'));

            if ($config->get('gamp.anonymize_ip', false)) {
                $analytics->setAnonymizeIp('1');
            }

            if ($config->get('gamp.async_requests', false)) {
                $analytics->setAsyncRequest(true);
            }

            return $analytics;
        });

        $this->app->alias(Analytics::class, 'gamp');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //
        return [Analytics::class, 'gamp'];
    }
}