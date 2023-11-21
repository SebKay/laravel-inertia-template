<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public static function values(): array
    {
        return \collect(self::cases())->map(fn ($case): string => $case->value)->toArray();
    }
}
