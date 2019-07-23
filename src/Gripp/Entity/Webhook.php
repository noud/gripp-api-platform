<?php

namespace App\Gripp\Entity;

use App\Entity\AbstractEntity\AbstractEntity;
use App\Gripp\Enum\Entity\Webhook\TriggerEnum;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Webhook extends AbstractEntity
{
    /**
     * @var TriggerEnum
     * @Assert\NotBlank
     * @Groups("write")
     */
    private $webhook_trigger;   //FOREIGN KEY: STRING

    /**
     * @var string
     * @Groups("write")
     */
    private $webhook_url;
    /**
     * @var int
     * @Groups("write")
     */
    private $errorcount;

    /**
     * @var string
     * @Groups("write")
     */
    private $extendedproperties;
}
