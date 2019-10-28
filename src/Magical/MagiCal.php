<?php

namespace Magical;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MagiCal
{
    /**
     * @var string The Secret token to be used for requests
     */
    private static $secretToken;

    /**
     * @var string The API token to be used for requests
     */
    private static $apiToken;

    /**
     * @var string The Dynamic token to be used for requests by users with Dynamic plan
     */
    private static $dynamicToken;

    /**
     * @var string The base URL for the MagiCal API
     */
    private static $endpoint = 'http://future-era.local:8080/api_new.magic-calendar.com/public'; //'https://api.magic-calendar.com';

    /**
     * @var string The version of the MagiCal API to use for requests
     */
    private static $apiVersion = 'v1';

    const VERSION = '1.0.0';


    /**
     * @return string The Secret token used for requests
     */
    public static function getSecretToken()
    {
        return self::$secretToken;
    }

    /**
     * @return string The API token used for requests
     */
    public static function getApiToken()
    {
        return self::$apiToken;
    }

    /**
     * @return string The Dynamic token used for requests by users with Dynamic plan
     */
    public static function getDynamicToken()
    {
        return self::$dynamicToken;
    }

    /**
     * Sets the Secret token to be used for requests
     *
     * @param string $secretToken
     */
    public static function setSecretToken($secretToken)
    {
        self::$secretToken = $secretToken;
    }

    /**
     * Sets the API token to be used for requests
     *
     * @param string $apiToken
     */
    public static function setApiToken($apiToken)
    {
        self::$apiToken = $apiToken;
    }

    /**
     * Sets the API token to be used for requests
     *
     * @param string $dynamicToken
     */
    public static function setDynamicToken($dynamicToken)
    {
        self::$dynamicToken = $dynamicToken;
    }

    /**
     * @return string The API version used for requests
     *
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getAuthUser() {
        return self::client('GET', 'auth/user');
    }

    /**
     * @param $method
     * @param $uri
     * @param null $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function client($method, $uri, $body = null) {

        if(MagiCal::getSecretToken() && MagiCal::getApiToken()) {

            $client = new Client([
                'base_uri' => self::$endpoint . "/" . self::$apiVersion . "/"
            ]);

            $data = [
                'headers' => self::httpHeaders(),
                'query' => self::httpQuery()
            ];

            if($body) {
                $data['form_params'] = $body;
            }

            try {

                $response = $client->request($method, $uri, $data);

                return json_decode($response->getBody()->getContents());

            } catch(RequestException $e) {

                $contents = json_decode($e->getResponse()->getBody()->getContents());
                $contents->code = $e->getCode();

                return $contents;
            }
        }

        return [
            'success' => 0,
            'message' => 'Invalid credentials. Please, set your Secret and API token.'
        ];
    }

    /**
     * @return array HTTP headers used for requests
     */
    private static function httpHeaders()
    {
        return [
            'Authorization' => self::$secretToken,
            'Accept' => 'application/json',
            'Version' => self::VERSION
        ];
    }

    /**
     * @return array HTTP query used for requests
     */
    private static function httpQuery()
    {
        $query = [
            'api_token' => self::$apiToken
        ];

        if(self::$dynamicToken) {

            $query['dynamic_token'] = self::$dynamicToken;
        }

        return $query;
    }
}