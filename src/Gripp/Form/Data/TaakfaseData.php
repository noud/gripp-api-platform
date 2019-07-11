<?php

namespace App\Gripp\Form\Data;

use App\Entity\Taakfase;
use Symfony\Component\Validator\Constraints as Assert;

class TaakfaseData
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;
    
    public function __construct(
        Taakfase $taakfase = null
    ) {
        if ($taakfase) {
            $this->name = $taakfase->getName();
        }
    }
}
