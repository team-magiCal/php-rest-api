<?php

namespace Magical\Objects;


class Customer
{
    /**
     * @var string, customer's title [Mr., Mrs. or Ms.] (optional)
     */
    public $person_title;

    /**
     * @var string, customer's first name (required)
     */
    public $first_name;

    /**
     * @var string, customer's last name (required)
     */
    public $last_name;

    /**
     * @var string, customer's email address (required)
     */
    public $email;

    /**
     * @var string, customer's phone number (optional)
     */
    public $phone;

    /**
     * @var string, description of reservation (optional)
     */
    public $description;

    /**
     * @var integer, number of adults (required)
     */
    public $adults;

    /**
     * @var integer, number of children (optional)
     */
    public $children;


    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->person_title = $data['person_title'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->description = $data['description'];
        $this->adults = $data['adults'];
        $this->children = $data['children'];
    }

}