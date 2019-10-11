<?php

namespace SenderPackage;

class SenderAddress
{
    public $customername = '';
    public $street = '';
    public $housenumber = '';
    public $country = '';
    public $zipcode = '';
    public $city = '';
    public $email = '';
    public $phone = '';

    public function __construct($data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $newkey          = str_replace("'", '', $key);
                $this->{$newkey} = $value;
            }
        }
    }

    public function setCustomerName($customername)
    {
        $this->customername = $customername;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setHouseNumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    public function setZipCode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}
