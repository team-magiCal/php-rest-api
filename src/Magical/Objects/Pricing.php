<?php

namespace Magical\Objects;

use Magical\MagiCal;
use Magical\Validator;

class Pricing
{

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function all() {

        return MagiCal::client('GET', 'pricing');
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function retrieve($id) {

        return MagiCal::client('GET', 'pricing/'.$id);
    }

    /**
     * @param $dateFrom
     * @param $dateTo
     * @param $price
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($dateFrom, $dateTo, $price) {

        if(Validator::validateDatesFormat($dateFrom, $dateTo)) {

            if(Validator::validateDates($dateFrom, $dateTo)) {

                $data = [
                    'date_from' => $dateFrom,
                    'date_to' => $dateTo,
                    'price' => $price
                ];

                $response = MagiCal::client('POST', 'pricing', $data);

                return $response;
            }

            return [
                'success' => 0,
                'code' => 422,
                'message' => 'The given data was invalid',
                'errors' => ['The DATE TO must be a date after or equal to DATE FROM.']
            ];
       }

        return [
            'success' => 0,
            'code' => 422,
            'message' => 'The given data was invalid',
            'errors' => ['Wrong date format. Date must be in YYYY-MM-DD format.']
        ];
    }

    /**
     * @param $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete($id) {

        return MagiCal::client('DELETE', 'pricing/'.$id);
    }
}