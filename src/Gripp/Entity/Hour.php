<?php

namespace App\Gripp\Entity;

use App\Entity\AbstractEntity\AbstractSearchableEntity;
use App\Gripp\Enum\Entity\Hour\StatusEnum;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Hour extends AbstractSearchableEntity
{
    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $userphoto;   //FOREIGN KEY: File

    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $task;   //FOREIGN KEY: Task

    /**
     * @var StatusEnum
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $status;

    /**
     * @var \DateTime
     * @Groups("write")
     */
    private $date;

    /**
     * @var string
     * @Groups("write")
     */
    private $description;

    /**
     * @var float
     * @Groups("write")
     */
    private $amount;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Groups("write")
     */
    private $employee;  //FOREIGN KEY: Employee

    /**
     * @var int
     * @Assert\NotBlank()
     * @Groups("write")
     */
    private $offerprojectbase;  //FOREIGN KEY: The ID of the offer or project.

    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $offerprojectline;  //FOREIGN KEY: Offerprojectline

    /**
     * @var \DateTime
     * @Groups("write")
     */
    private $authorizedon;

    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $authorizedby;  //FOREIGN KEY: Employee

    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $definitiveby;  //FOREIGN KEY: Employee

    /**
     * @var \DateTime
     * @Groups("write")
     */
    private $definitiveon;

    /**
     * @var string
     * @Groups("write")
     */
    private $extendedproperties;
}
