<?php

namespace App\Gripp\Entity;

use App\Entity\AbstractEntity\AbstractSearchableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

class File extends AbstractSearchableEntity
{
    const API_NAME = 'file';

    /**
     * @var string
     * @Groups("write")
     */
    private $title;

    /**
     * @var string
     * @Groups("write")
     */
    private $previewdatasmall;

    /**
     * @var string
     * @Groups("write")
     */
    private $extendedproperties;
}
