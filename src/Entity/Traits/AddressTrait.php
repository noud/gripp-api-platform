<?php

namespace App\Entity\Traits;

trait AddressTrait
{
    public function getAddress()
    {
        return trim($this->getStreet().' '.$this->getStreetNumber()).', '.$this->getZipcode().' '.$this->getCity();
    }
}
