<?php

namespace App\Enum;

abstract class AbstractEnum
{
    /**
     * @return string[]
     */
    abstract public static function getLabels(): array;

    public static function getLabel(?string $index, $default = ''): string
    {
        return static::getLabels()[$index] ?? $default;
    }

    public static function getChoices(): array
    {
        return array_flip(static::getLabels());
    }
}
