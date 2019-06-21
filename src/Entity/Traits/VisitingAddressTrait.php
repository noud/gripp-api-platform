<?php

namespace App\Entity\Traits;

trait VisitingAddressTrait
{
    use AddressTrait;
    
    public function getStreet()
    {
        return $this->getVisitingaddressStreet();
    }
    
    public function getStreetNumber()
    {
        return $this->getVisitingaddressStreetNumber();
    }
    
    public function getZipcode()
    {
        return $this->getVisitingaddressZipcode();
    }
    
    public function getCity()
    {
        return $this->getVisitingaddressCity();
    }
}
