<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasValues;

enum ApprovalStatus: string
{
    use HasValues;

    case PENDING = "pending";
    case CHANGE_REQUESTED = "changed-requested";
    case UPDATED = 'updated';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
