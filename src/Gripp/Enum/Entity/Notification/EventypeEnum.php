<?php

namespace App\Gripp\Enum\Entity\Notification;

use App\Gripp\Enum\AbstractEnum;

class EventypeEnum extends AbstractEnum
{
    const NOTIFICATION = 'NOTIFICATION';
    const WARNING = 'WARNING';
    const ERROR = 'ERROR';
    const SYSTEMMESSAGE = 'SYSTEMMESSAGE';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::NOTIFICATION => 'enum.notification.eventype.notification',
            self::WARNING => 'enum.notification.eventype.warning',
            self::ERROR => 'enum.notification.eventype.error',
            self::SYSTEMMESSAGE => 'enum.notification.eventype.systemmessage',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
