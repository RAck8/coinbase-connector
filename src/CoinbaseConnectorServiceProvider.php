<?php

namespace GustavTrenwith\Coinbase;

use Illuminate\Support\ServiceProvider;

/**
 * Class CoinbaseConnectorServiceProvider
 * @package gustavtrenwith\coinbase
 * @author Gustav Trenwith <gtrenwith@gmail.com>
 */
class CoinbaseConnectorServiceProvider extends ServiceProvider {

    /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
    * Bootstrap the application events.
    *
    * @return void
    */
    public function boot()
    {
        # Publish the config
        $this->publishes([
            __DIR__.'/config/coinbase.php' => base_path('config/coinbase.php'),
        ]);
    }

    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {

    }
}
