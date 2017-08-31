<?php

return [
    'auth_uri' => env('COINBASE_AUTHORIZE_URI', 'https://www.coinbase.com/oauth/authorize'),
    'token_uri' => env('COINBASE_ACCESS_TOKEN_URL', 'https://api.coinbase.com/oauth/token'),
    'client_id' => env('COINBASE_CLIENT_ID', ''),
    'client_secret' => env('COINBASE_CLIENT_SECRET', '')
];
