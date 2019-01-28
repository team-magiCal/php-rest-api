<?php

namespace Magical\Objects;

class Reservation
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $checkIn;

    /**
     * @var string
     */
    public $checkOut;

    /**
     * @param $checkIn
     * @param $checkOut
     */
    public function setDates($checkIn,$checkOut){
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
    }

}