<?php

namespace App\Enums;

enum Permission: string
{
    case ACCESS_ADMIN = 'access-filament';

    case EDIT_ORGANISATION = 'edit-organisation';
    case UPDATE_ORGANISATION = 'update-organisation';

    case CREATE_POSTS = 'create-posts';
    case VIEW_POSTS = 'view-posts';
    case EDIT_POSTS = 'edit-posts';
    case UPDATE_POSTS = 'update-posts';
    case DELETE_POSTS = 'delete-posts';

    public static function values(): array
    {
        return \collect(self::cases())->map(fn ($case): string => $case->value)->toArray();
    }
}
