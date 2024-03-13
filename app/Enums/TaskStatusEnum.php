<?php

namespace App\Enum;

enum TaskStatusEnum: string
{
    case ACTIVE = 'active';
    case COMPLETE = 'complete';
    case REMOVED = 'removed';
}