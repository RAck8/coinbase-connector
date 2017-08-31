<?php

namespace GustavTrenwith\Coinbase;

use Illuminate\Support\Facades\Facade;

/**
 * Class CoinbaseConnectorFacade
 * @package gustavtrenwith\coinbase
 * @author Gustav Trenwith <gtrenwith@gmail.com>
 */
class CoinbaseConnectorFacade extends Facade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CoinbaseConnector';
    }
}
