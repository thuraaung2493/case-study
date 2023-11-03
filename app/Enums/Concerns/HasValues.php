<?php

declare(strict_types=1);

namespace App\Enums\Concerns;

use BackedEnum;

trait HasValues
{
    public static function values(): array
    {
        return \array_map(fn (BackedEnum $role) => $role->value, self::cases());
    }
}
