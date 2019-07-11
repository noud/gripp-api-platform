<?php

namespace App\Enum\API;

use App\Enum\AbstractEnum;

class FiltersOperatorEnum extends AbstractEnum
{
    const EQUALS = 'equals';
    const GREATEREQUALS = 'greaterequals';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::EQUALS => 'enum.filters_operator.equals',
            self::GREATEREQUALS => 'enum.filters_operator.greaterequals',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
