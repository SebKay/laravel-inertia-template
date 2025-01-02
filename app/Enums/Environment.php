<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Environment: string
{
    case LOCAL = 'local';
    case TESTING = 'testing';
    case PRODUCTION = 'production';
    case STAGING = 'staging';

    public static function values(): Collection
    {
        return collect(self::cases())->map(fn ($case): string => $case->value);
    }
}
