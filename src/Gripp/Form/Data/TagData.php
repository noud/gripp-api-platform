<?php

namespace App\Gripp\Form\Data;

use App\Gripp\Entity\Tag;
use Symfony\Component\Validator\Constraints as Assert;

class TagData
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;
    
    public function __construct(
        Tag $tag = null
    ) {
        if ($tag) {
            $this->name = $tag->getName();
        }
    }
}
