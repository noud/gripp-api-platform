<?php

namespace App\Entity\Traits;

trait FullnameTrait
{
    public function getName(): ?string
    {
        return trim($this->getFirstname().' '.$this->getInfix()).' '.$this->getLastname();
        //return ('PRIVATEPERSON' === $this->getRelationtype()) ? trim($this->getFirstname().' '.$this->getInfix()).' '.$this->getLastname() ? '';  // @TODO PRIVATEPERSON
    }
}
