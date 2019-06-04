<?php

namespace App\Gripp\Entity;

use App\Gripp\Enum\Entity\Notification\EventypeEnum;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Notification
{
    const API_NAME = 'notification';

    /**
     * @var array[int]
     * @Groups("write")
     */
    private $employeeids;    //FOREIGN KEY: An array of employee IDs

    /**
     * @var string
     * @Groups("write")
     */
    private $title; // The title of the message

    /**
     * @var string
     * @Groups("write")
     */
    private $body; // The body of the message

    /**
     * @var EventypeEnum
     * @Assert\NotBlank
     * @Groups("write")
     */
    private $eventype;
}
