<?php

namespace App\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractExtendedPropertiesEntity
 */
abstract class AbstractExtendedPropertiesNoSearchableEntity extends \App\Entity\AbstractEntity\AbstractEntity
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="extendedproperties", type="string", length=255, nullable=true)
     */
    protected $extendedproperties;

    public function getExtendedproperties(): ?string
    {
        return $this->extendedproperties;
    }

    public function setExtendedproperties(?string $extendedproperties): self
    {
        $this->extendedproperties = $extendedproperties;

        return $this;
    }
}
