<?php

namespace App\Gripp\Entity\AbstractEntities;

abstract class AbstractSearchableEntity extends AbstractEntity
{
    /**
     * @var string
     */
    protected $searchname;

    public function getSearchname(): string
    {
        return $this->searchname;
    }
}
