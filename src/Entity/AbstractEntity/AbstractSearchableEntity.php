<?php

namespace App\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractSearchableEntity extends AbstractEntity
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="searchname", type="string", length=255, nullable=true)
     */
    protected $searchname;

    public function getSearchname(): ?string
    {
        return $this->searchname;
    }
    
    public function setSearchname(?string $searchname): void
    {
        $this->searchname = $searchname;
    }
}
