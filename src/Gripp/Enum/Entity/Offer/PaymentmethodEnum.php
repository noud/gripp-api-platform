<?php

namespace App\Gripp\Enum\Entity\Offer;

use App\Gripp\Enum\AbstractEnum;

class PaymentmethodEnum extends AbstractEnum
{
    const MANUALTRANSFER = 'MANUALTRANSFER';
    const AUTOMATICTRANSFER = 'AUTOMATICTRANSFER';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::MANUALTRANSFER => 'enum.offer.paymentmethod.manual_transfer',
            self::AUTOMATICTRANSFER => 'enum.offer.paymentmethod.automatic_transfer',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
