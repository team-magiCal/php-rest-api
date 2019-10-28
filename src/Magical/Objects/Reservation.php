<?php

namespace Magical\Objects;

use Magical\MagiCal;

class Reservation
{
    /**
     * @var string, check-in date in format 'Y-m-d'
     */
    public static $checkIn;

    /**
     * @var string, check-out date in format 'Y-m-d'
     * Must be grater then check-in date
     */
    public static $checkOut;


    /**
     * @param $checkIn
     * @param $checkOut
     */
    public static function setDates($checkIn, $checkOut)
    {
        self::$checkIn = $checkIn;
        self::$checkOut = $checkOut;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function all() {
        return MagiCal::client('GET', 'reservations');
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($id) {

        return MagiCal::client('GET', 'reservations/'.$id);
    }

    /**
     * @param Customer $customer
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create(Customer $customer)
    {
        $data = [
            'date_from' => self::$checkIn,
            'date_to' => self::$checkOut
        ];

        foreach ($customer as $key => $value) {
            $data[$key] = $value;
        }

        $response = MagiCal::client('POST', 'reservations', $data);

        return $response;
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete($id) {

        return MagiCal::client('DELETE', 'reservations/'.$id);
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function approve($id) {

        return MagiCal::client('POST', 'reservations/'.$id.'/approve');
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function disapprove($id) {

        return MagiCal::client('POST', 'reservations/'.$id.'/disapprove');
    }

}