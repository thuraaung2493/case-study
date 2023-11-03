<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role as EnumsRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = \collect(EnumsRole::values())
            ->map(fn (string $role) => [
                'name' => $role,
                'created_at' => \now(),
                'updated_at' => \now(),
            ])
            ->toArray();

        Role::query()->insert($data);

        $bmRole = Role::query()->where('name', EnumsRole::BM->value)->first();
        $foRole = Role::query()->where('name', EnumsRole::FO->value)->first();

        User::factory()->count(3)->create(['role_id' => $bmRole->id]);
        User::factory()->count(3)->create(['role_id' => $foRole->id]);
    }
}
