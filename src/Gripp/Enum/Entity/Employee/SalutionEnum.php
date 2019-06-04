<?php

namespace App\Gripp\Enum\Entity\Employee;

use App\Gripp\Enum\AbstractEnum;

class SalutionEnum extends AbstractEnum
{
    const SIR = 'SIR';
    const MADAM = 'MADAM';
    const SIRMADAM = 'SIRMADAM';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::SIR => 'enum.salution.sir',
            self::MADAM => 'enum.salution.madam',
            self::SIRMADAM => 'enum.salution.sirmadam',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
