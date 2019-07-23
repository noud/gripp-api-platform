<?php

namespace App\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractNameEntity
 */
abstract class AbstractNameNoExtendedPropertiesEntity extends \App\Entity\AbstractEntity\AbstractSearchableEntity
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
