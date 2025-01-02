<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Queue: string
{
    case DEFAULT = 'default';
    case MAIL = 'mail';

    public static function values(): Collection
    {
        return collect(self::cases())->map(fn ($case): string => $case->value);
    }
}
