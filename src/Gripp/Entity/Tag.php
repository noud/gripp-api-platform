<?php

namespace App\Gripp\Entity;

use App\Gripp\Entity\AbstractEntities\AbstractSearchableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

class Tag extends AbstractSearchableEntity
{
    const API_NAME = 'tag';

    /**
     * @var string
     * @Groups("write")
     */
    protected $name;

    /**
     * @var string
     * @Groups("write")
     */
    protected $extendedproperties;

    public function getName(): string
    {
        return $this->name;
    }

    public function getExtendedproperties(): string
    {
        return $this->extendedproperties;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setExtendedproperties(string $extendedproperties)
    {
        $this->extendedproperties = $extendedproperties;
    }
}
