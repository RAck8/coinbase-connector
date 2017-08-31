# coinbase-connector
OAuth2 Connector for the Coinbase Connect API, not covered by the official Coinbase PHP library

## Installation

### Composer

Begin by installing this package through Composer.

```bash
composer require gustavtrenwith/coinbase_connector
```

Then run `composer update`

### Register Service Provider and Facade

Then register the service providers and Facades in `config/app.php`
```
GustavTrenwith\Coinbase\CoinbaseConnectorServiceProvider::class,
```
```
'CoinbaseConnector' => GustavTrenwith\Coinbase\CoinbaseConnectorFacade::class,
```

Now you can use the  ```CoinbaseConnector``` facade anywhere in your application

### Add the following environment variables to the `.env` file

```
COINBASE_AUTHORIZE_URI=https://www.coinbase.com/oauth/authorize
COINBASE_ACCESS_TOKEN_URL=https://api.coinbase.com/oauth/token
COINBASE_CLIENT_ID=your_client_id
COINBASE_CLIENT_SECRET=your__client_secret
```

### Publish the config file
Run the following command to automatically add the coinbase config file to the config directory
```
php artisan vendor:publish
```

# Questions
Feel free to email me if you have any questions: `gtrenwith@gmail.com`