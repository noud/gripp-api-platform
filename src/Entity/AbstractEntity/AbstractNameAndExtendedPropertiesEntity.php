<?php

namespace App\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractNameAndExtendedPropertiesEntity
 */
abstract class AbstractNameAndExtendedPropertiesEntity extends \App\Entity\AbstractEntity\AbstractSearchableEntity
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extendedproperties", type="string", length=255, nullable=true)
     */
    protected $extendedproperties;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExtendedproperties(): ?string
    {
        return $this->extendedproperties;
    }

    public function setExtendedproperties(?string $extendedproperties): self
    {
        $this->extendedproperties = $extendedproperties;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
