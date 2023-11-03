<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\LoanField;
use Illuminate\Http\Request;

final class LoanController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $loans = LoanField::query()->paginate(8);

        return \view('admin.loans.index', [
            'loans' => $loans,
        ]);
    }
}
