<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\Status;
use App\Http\Responses\API\MessageOnlyResponse;
use Exception;

class UnauthorizedException extends Exception
{
    public function render(Request $request): Response|bool
    {
        if ($request->isJson()) {
            (new MessageOnlyResponse(
                message: $this->message,
                status: Status::UNAUTHORIZED,
            ))->toResponse($request);
        }

        return false;
    }
}
