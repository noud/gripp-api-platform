<?php

namespace App\Gripp\Enum\Entity\Offer;

use App\Gripp\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    const PROJECT_RUNNING = 'PROJECT_RUNNING';
    const PROJECT_COMPLETED = 'PROJECT_COMPLETED';
    const CONCEPT = 'CONCEPT';
    const REJECTED = 'REJECTED';
    const SENT = 'SENT';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::PROJECT_RUNNING => 'enum.offer.status.project_running',
            self::PROJECT_COMPLETED => 'enum.offer.status.project_completed',
            self::CONCEPT => 'enum.offer.status.concept',
            self::REJECTED => 'enum.offer.status.rejected',
            self::SENT => 'enum.offer.status.sent',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
