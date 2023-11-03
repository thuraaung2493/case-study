<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\BranchManagerLogin;
use Illuminate\Http\Request;

final class LoginController
{
    public function __construct(
        private BranchManagerLogin $branchManagerLogin,
    ) {
    }

    public function __invoke(Request $request)
    {
        $this->branchManagerLogin->handle($request);

        return \redirect()->intended(\route('clients'));
    }
}
