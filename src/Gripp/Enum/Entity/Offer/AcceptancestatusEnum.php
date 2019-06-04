<?php

namespace App\Gripp\Enum\Entity\Offer;

use App\Gripp\Enum\AbstractEnum;

class AcceptancestatusEnum extends AbstractEnum
{
    const ACCEPTED = 'ACCEPTED';
    const REJECTED = 'REJECTED';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::ACCEPTED => 'enum.offer.acceptancestatus.accepted',
            self::REJECTED => 'enum.offer.acceptancestatus.rejected',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
