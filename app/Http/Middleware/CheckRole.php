<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use App\Enums\Status;
use App\Http\Responses\API\MessageOnlyResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var User|null */
        $user = Auth::user();

        \abort_if(\is_null($user), Status::UNAUTHORIZED, 'Unauthorized!');

        if ($user->role->has(Role::from($role))) {
            return $next($request);
        }

        if ($request->isJson() && $request->is('api/*')) {
            return new MessageOnlyResponse('You don\'t have permission to access it!', Status::FORBIDDEN);
        }

        \abort(
            code: Status::FORBIDDEN->value,
            message: 'You don\'t have permission to access it!',
        );
    }
}
