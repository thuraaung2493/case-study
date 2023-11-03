<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;

final class FieldOfficerLogin
{
    public function handle(Request $request): NewAccessToken
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $request->email)->first();

        if ($this->checkAuth($user, $request->password)) {
            return $user->createToken($user->email);
        }

        throw new UnauthorizedException('Unauthorized!');
    }

    public function checkAuth(?User $user, string $password): bool
    {
        return $user &&
            $user->isFieldOfficer() &&
            Hash::check($password, $user->password);
    }
}
