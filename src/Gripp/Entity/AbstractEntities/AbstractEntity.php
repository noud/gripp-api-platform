<?php

namespace App\Gripp\Entity\AbstractEntities;

use DateTime;

abstract class AbstractEntity
{
    /**
     * @var DateTime
     */
    protected $createdon;

    /**
     * @var \DateTime
     */
    protected $updatedon;

    /**
     * @var int
     */
    protected $id;

    public function getCreatedon(): \DateTime
    {
        return $this->createdon;
    }

    public function getUpdatedon(): \DateTime
    {
        return $this->updatedon;
    }

    public function getId(): int
    {
        return $this->id;
    }
}