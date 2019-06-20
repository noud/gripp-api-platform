<?php

namespace App\Entity\Traits;

trait FullnameTrait
{
    public function getName()
    {
        return trim($this->getFirstname().' '.$this->getLastname());
    }
}
