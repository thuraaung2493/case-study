<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasValues;

enum Role: string
{
    use HasValues;

    case FO = "field_officer";
    case BM = "branch_manager";
}
