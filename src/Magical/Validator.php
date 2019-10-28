<?php

namespace Magical;

class Validator
{

    /**
     * @param string $date_from
     * @param string $date_to
     * @return bool
     */
    public static function validateDatesFormat($date_from, $date_to) {

        $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";

        if (preg_match($pattern, $date_from) && preg_match($pattern, $date_to)) {

            $date_from_arr  = explode('-', $date_from);
            $date_to_arr  = explode('-', $date_to);

            var_dump(intval($date_from_arr[0]));


            if(checkdate(intval($date_from_arr[1]), intval($date_from_arr[2]), intval($date_from_arr[0])) && checkdate(intval($date_to_arr[1]), intval($date_to_arr[2]), intval($date_to_arr[0]))) {

                return true;
            }

            return false;

        }

        return false;
    }

    /**
     * @param $date_from
     * @param $date_to
     * @return bool
     */
    public static function validateDates($date_from, $date_to) {

        if($date_from <= $date_to) {

            return true;
        }

        return false;
    }
}