<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Actions\FieldOfficerLogin;
use App\Http\Resources\TokenResource;
use App\Http\Responses\API\SuccessResponse;
use Illuminate\Http\Request;

final class LoginController
{
    public function __construct(
        private FieldOfficerLogin $fieldOfficerLogin,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $token = $this->fieldOfficerLogin->handle($request);

        return new SuccessResponse(
            resource: new TokenResource($token),
        );
    }
}
