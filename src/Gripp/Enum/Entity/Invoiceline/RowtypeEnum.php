<?php

namespace App\Gripp\Enum\Entity\Invoiceline;

use App\Gripp\Enum\AbstractEnum;

class RowtypeEnum extends AbstractEnum
{
    const NORMAL = 'NORMAL';
    const GROUP = 'GROUP';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::NORMAL => 'enum.invoiceline.rowtype.normal',
            self::GROUP => 'enum.invoiceline.rowtype.group',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
