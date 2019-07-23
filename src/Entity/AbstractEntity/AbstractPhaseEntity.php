<?php

namespace App\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractPhaseEntity extends \App\Entity\AbstractEntity\AbstractNameAndExtendedPropertiesEntity
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     * @Groups("write")
     */
    protected $color;  // "#ff00ff"

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color)
    {
        $this->color = $color;
    }
}
