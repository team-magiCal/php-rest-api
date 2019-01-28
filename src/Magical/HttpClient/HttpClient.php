<?php

namespace Magical\HttpClient;

use Magical\Client;

class HttpClient
{
    const API_VERSION = 'v1';
    const ENDPOINT = 'https://api.magic-calendar.com';

    /**
     * @var string
     */
    public $apiToken;

    /**
     * @var string
     */
    public $dynamicToken;

    /**
     * @var string
     */
    public $secretToken;

    /**
     * @var array
     */
    private $authorization;

    const REQUEST_GET = 'GET';
    const REQUEST_POST = 'POST';
    const REQUEST_DELETE = 'DELETE';

    /**
     * @param $secretToken
     */
    public function setAuthorization($secretToken){

        $this->secretToken = $secretToken;
        $this->authorization = ['Authorization: ' . $secretToken];

    }

    public function get(){

        $data = [
            'apiToken' => $this->apiToken,
            'dynamicToken' => $this->dynamicToken,
        ];

        $url = self::ENDPOINT."/".self::API_VERSION."/reservation?apiToken=".$data['apiToken'];

        if(isset($this->dynamicToken)){
            $data['dynamicToken'] = $this->dynamicToken;

            $url .= "&dynamicToken=".$data['dynamicToken'];
        }

        $options = [
            CURLOPT_HTTPHEADER => $this->authorization,
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => 1
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function create($reservation){

        $data = [
            'apiToken' => $this->apiToken,
            'date_from' => $reservation->checkIn,
            'date_to' => $reservation->checkOut
        ];

        if(isset($this->dynamicToken)){
           $data['dynamicToken'] = $this->dynamicToken;
        }

        $options = [
            CURLOPT_HTTPHEADER => $this->authorization,
            CURLOPT_URL => self::ENDPOINT."/".self::API_VERSION."/reservation",
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }

    public function delete($id){

        $data = [
            'apiToken' => $this->apiToken,
            'reservation_id' => $id
        ];

        $url = self::ENDPOINT."/".self::API_VERSION."/reservation?apiToken=".$data['apiToken']."&reservation_id=".$data['reservation_id'];

        if(isset($this->dynamicToken)){
            $data['dynamicToken'] = $this->dynamicToken;

            $url .= "&dynamicToken=".$data['dynamicToken'];
        }

        $options = [
            CURLOPT_HTTPHEADER => $this->authorization,
            CURLOPT_URL => $url,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => 0,
            CURLOPT_CUSTOMREQUEST => "DELETE"
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }
}
