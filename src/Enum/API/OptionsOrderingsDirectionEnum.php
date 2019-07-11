<?php

namespace App\Enum\API;

use App\Enum\AbstractEnum;

class OptionsOrderingsDirectionEnum extends AbstractEnum
{
    const ASC = 'asc';
    const DESC = 'desc';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::ASC => 'enum.options_orderings_direction.asc',
            self::DESC => 'enum.options_orderings_direction.desc',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
