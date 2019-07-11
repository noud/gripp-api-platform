<?php

namespace App\Gripp\Entity;

use App\Entity\AbstractEntity\AbstractSearchableEntity;
use App\Gripp\Enum\Entity\Employee\SalutionEnum;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Employee extends AbstractSearchableEntity
{
    const API_NAME = 'employee';

    /**
     * @var int
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $userphoto;   //FOREIGN KEY: File

    /**
     * @var string
     * @Groups("write")
     */
    private $title;

    /**
     * @var string
     * @Groups("write")
     */
    private $screenname;

    /**
     * @var int
     * @Groups("write")
     */
    private $number;

    /**
     * @var \DateTime
     * @Groups("write")
     */
    private $dateofbirth;

    /**
     * @var string
     * @Groups("write")
     */
    private $socialsecuritynumber;

    /**
     * @var string
     * @Assert\Email(
     *     checkMX = true,
     *     mode = html5
     * )
     * @Groups("write")
     */
    private $emailprivate;

    /**
     * @var string
     * @Groups("write")
     */
    private $bankaccount;

    /**
     * @var string
     * @Groups("write")
     */
    private $bankcity;

    /**
     * @var string
     * @Groups("write")
     */
    private $bankascription;

    /**
     * @var string
     * @Groups("write")
     */
    private $notes;

    /**
     * @var \DateTime
     * @Groups("write")
     */
    private $employeesince;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Groups("write")
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Groups("write")
     */
    private $password;

    /**
     * @var bool
     * @Groups("write")
     */
    private $active;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Groups("write")
     */
    private $role;  //FOREIGN KEY: The ID of the role. These are listed on the settings page within Gripp. (Instellingen > rechtenprofielen)

    /**
     * @var string
     * @Groups("write")
     */
    private $email;

    /**
     * @var string
     * @Groups("write")
     */
    private $phone;

    /**
     * @var string
     * @Groups("write")
     */
    private $mobile;

    /**
     * @var string
     * @Groups("write")
     */
    private $street;

    /**
     * @var string
     * @Groups("write")
     */
    private $adresline2;

    /**
     * @var string
     * @Groups("write")
     */
    private $streetnumber;

    /**
     * @var string
     * @Groups("write")
     */
    private $zipcode;

    /**
     * @var string
     * @Groups("write")
     */
    private $city;

    /**
     * @var string
     * @Groups("write")
     */
    private $country;

    /**
     * @var string
     * @Groups("write")
     */
    private $function;

    /**
     * @var SalutionEnum
     * @Assert\NotBlank(allowNull=true)
     * @Groups("write")
     */
    private $salutation;

    /**
     * @var string
     * @Groups("write")
     */
    private $initials;

    /**
     * @var string
     * @Groups("write")
     */
    private $firstname;

    /**
     * @var string
     * @Groups("write")
     */
    private $infix;

    /**
     * @var string
     * @Groups("write")
     */
    private $lastname;

    /**
     * @var string
     * @Groups("write")
     */
    private $extendedproperties;

    /**
     * @var array[int]
     * @Groups("write")
     */
    private $tags;  //FOREIGN KEY: Tag

    /**
     * @var array[int]
     * @Groups("write")
     */
    private $skills;    //FOREIGN KEY: Tasktype
}
