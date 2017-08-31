<?php

namespace gustavtrenwith\coinbase_connector;

/**
 * Class Connector
 * @package gustavtrenwith\coinbase
 * @author Gustav Trenwith <gtrenwith@gmail.com>
 */
class Connector
{
    private $authorizeURI;
    private $clientID;

    public function __construct()
    {
        $this->authorizeURI = config('coinbase.auth_uri', 'https://www.coinbase.com/oauth/authorize');
        $this->clientID = config('coinbase.client_id', '');
    }

    /**
     * Handles the handshake with Coinbase Connect to get the users access token
     * @see https://developers.coinbase.com/docs/wallet/permissions for a list of permissions
     * @param bool $redirectUri The redirect uri
     * @param string $state A secret string to pass along with the request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function requestAccess($redirectUri, $state)
    {
        return redirect(
            $this->authorizeURI
            . '?response_type=code'
            . '&client_id=' . $this->clientID
            . '&redirect_uri=' . $redirectUri
            . '&state=' . $state
            . '&scope=wallet:deposits:create,wallet:accounts:read'
        );
    }

    /**
     * Sends an authorization token to Coinbase and replaces gets an access and refresh token
     * @param string $code
     * @param boolean $redirectUri
     * @return mixed
     */
    public function getAccessToken($code, $redirectUri)
    {
        return $this->post(
            [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => config('coinbase.client_id'),
                'client_secret' => config('coinbase.client_secret'),
                'redirect_uri' => $redirectUri
            ],
            config('coinbase.token_uri', 'https://api.coinbase.com/oauth/token')
        );
    }

    /**
     * Refreshes the access token
     * @param string $refreshToken
     * @return mixed
     */
    public function refreshAccessToken($refreshToken)
    {
        return $this->post(
            [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => env('COINBASE_CLIENT_ID'),
                'client_secret' => env('COINBASE_CLIENT_SECRET'),
            ],
            config('coinbase.token_uri', 'https://api.coinbase.com/oauth/token')
        );
    }

    /**
     * Sends POST requests using the CURL PHP library
     * @param array $fields
     * @param string $url
     * @return mixed
     */
    protected function post($fields = [], $url = 'https://api.coinbase.com/oauth/token')
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_ENCODING => "",
            CURLOPT_USERAGENT => "CoinbaseConnector",
            CURLOPT_AUTOREFERER => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($fields)
        ];

        $curl = curl_init($url);
        curl_setopt_array($curl, $options);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response;
    }
}
