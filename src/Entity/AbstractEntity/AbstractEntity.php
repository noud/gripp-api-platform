<?php

namespace App\Entity\AbstractEntity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

abstract class AbstractEntity
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdat;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedat;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getCreatedat(): DateTimeInterface
    {
        return $this->createdat;
    }
    
    public function getUpdatedat(): DateTimeInterface
    {
        return $this->updatedat;
    }
    
    /**
     * Gripp API
     */
    
    public function getCreatedon(): DateTimeInterface
    {
        return $this->createdat;
    }
    
    public function getUpdatedon(): DateTimeInterface
    {
        return $this->updatedat;
    }
    
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    
    public function setCreatedon(?DateTime $createdon): void
    {
        $this->createdat = $createdon;
    }
    
    public function setUpdatedon(?DateTime $updatedon): void
    {
        $this->updatedat = $updatedon;
    }
}
