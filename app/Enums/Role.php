<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case USER = 'user';

    public static function values(): array
    {
        return \collect(self::cases())->map(fn ($case): string => $case->value)->toArray();
    }
}
