<?php

namespace Magical;

use Magical\HttpClient\HttpClient;

/**
 * Class Client
 * @package Magical
 */
class Client
{
    /**
     * @var object
     */
    protected $httpClient;

    /**
     * Client constructor.
     * @param $apiToken
     * @param null $dynamicToken
     */
    public function __construct($apiToken, $dynamicToken = null){

        $this->httpClient = new HttpClient;

        $this->httpClient->apiToken = $apiToken;
        $this->httpClient->dynamicToken = $dynamicToken;

    }

    /**
     * @param $secretToken
     */
    public function setSecretToken($secretToken){

         $this->httpClient->setAuthorization($secretToken);

    }

    public function getReservations(){

        return $this->httpClient->get();

    }

    /**
     * @param $reservation
     * @return mixed
     */
    public function makeReservation($reservation){

        return $this->httpClient->create($reservation);

    }

    /**
     * @param $reservation
     * @return mixed
     */
    public function deleteReservation($reservation){

        return $this->httpClient->delete($reservation->id);

    }
}