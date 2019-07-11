<?php

namespace App\Form\Data;

use App\Entity\Tag;
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
