<?php

namespace App\Gripp\Enum\Entity\Offer;

use App\Gripp\Enum\AbstractEnum;

class FrequencyEnum extends AbstractEnum
{
    const EVERYMONTH = 'EVERYMONTH';
    const EVERYQUARTER = 'EVERYQUARTER';
    const EVERY6MONTHS = 'EVERY6MONTHS';
    const EVERYYEAR = 'EVERYYEAR';
    const EVERY18MONTHS = 'EVERY18MONTHS';
    const EVERYTWOYEARS = 'EVERYTWOYEARS';
    const EVERYWEEK = 'EVERYWEEK';
    const EVERYTWOWEEKS = 'EVERYTWOWEEKS';
    const EVERYTHREEYEARS = 'EVERYTHREEYEARS';
    const EVERYFOURYEARS = 'EVERYFOURYEARS';
    const EVERYFIVEYEARS = 'EVERYFIVEYEARS';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::EVERYMONTH => 'enum.offer.frequency.everymonth',
            self::EVERYQUARTER => 'enum.offer.frequency.everyauarter',
            self::EVERY6MONTHS => 'enum.offer.frequency.every6months',
            self::EVERYYEAR => 'enum.offer.frequency.everyyear',
            self::EVERY18MONTHS => 'enum.offer.frequency.every18months',
            self::EVERYTWOYEARS => 'enum.offer.frequency.everytwoyears',
            self::EVERYWEEK => 'enum.offer.frequency.everyweek',
            self::EVERYTWOWEEKS => 'enum.offer.frequency.everytwoweeks',
            self::EVERYTHREEYEARS => 'enum.offer.frequency.everythreeyears',
            self::EVERYFOURYEARS => 'enum.offer.frequency.everyfouryears',
            self::EVERYFIVEYEARS => 'enum.offer.frequency.everyfiveyears',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
