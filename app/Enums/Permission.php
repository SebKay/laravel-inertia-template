<?php

namespace App\Enums;

enum Permission: string
{
    case EDIT_ORGANISATION = 'manage-organisation';
    case UPDATE_ORGANISATION = 'update-organisation';

    case CREATE_TASK_LISTS = 'create-posts';
    case VIEW_TASK_LISTS = 'view-posts';
    case EDIT_TASK_LISTS = 'edit-posts';
    case UPDATE_TASK_LISTS = 'update-posts';
    case DELETE_TASK_LISTS = 'delete-posts';

    public static function values(): array
    {
        return \collect(self::cases())->map(fn ($case): string => $case->value)->toArray();
    }
}
