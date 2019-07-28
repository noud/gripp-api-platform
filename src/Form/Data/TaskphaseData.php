<?php

namespace App\Form\Data;

use App\Entity\Taskphase;
use Symfony\Component\Validator\Constraints as Assert;

class TaskphaseData
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;
    
    public function __construct(
        Taskphase $taskphase = null
    ) {
        if ($taskphase) {
            $this->name = $taskphase->getName();
        }
    }
}
