<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class IsIntTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('is_int', [
                $this,
                'isInt'
            ])
        ];
    }

    public function isInt($int)
    {
        return is_int($int);
    }
}