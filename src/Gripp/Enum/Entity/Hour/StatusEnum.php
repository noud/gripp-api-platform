<?php

namespace App\Gripp\Enum\Entity\Hour;

use App\Gripp\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    const CONCEPT = 'CONCEPT';
    const DEFINITIVE = 'DEFINITIVE';
    const AUTHORIZED = 'AUTHORIZED';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::CONCEPT => 'enum.hour.status.concept',
            self::DEFINITIVE => 'enum.hour.status.definitive',
            self::AUTHORIZED => 'enum.hour.status.authorized',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
