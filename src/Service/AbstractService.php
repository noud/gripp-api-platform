<?php

namespace App\Service;


abstract class AbstractService
{
    protected function getClassName(): string
    {
        $fullClassName = get_class($this);
        $fullClassNameParts = explode('\\', $fullClassName);
        return str_replace('Service', '', end($fullClassNameParts));
    }
    
    protected function getLowercaseClassName(): string
    {
        return strtolower($this->getClassName());
    }
}
