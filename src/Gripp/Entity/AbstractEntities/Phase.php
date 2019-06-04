<?php

namespace App\Gripp\Entity\AbstractEntities;

use App\Gripp\Entity\Tag;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class Phase extends Tag
{
    const API_NAME = 'phase';

    /**
     * @var string
     * @Groups("write")
     */
    protected $color;  // "#ff00ff"

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }
}
