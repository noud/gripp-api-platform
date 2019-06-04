<?php

namespace App\Gripp\Enum\API;

use App\Gripp\Enum\AbstractEnum;

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
