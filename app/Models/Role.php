<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Role as EnumsRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property EnumsRole $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name' => EnumsRole::class,
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function has(EnumsRole $role): bool
    {
        return $this->name === $role;
    }
}
