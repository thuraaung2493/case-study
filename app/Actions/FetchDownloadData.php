<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Client;
use App\Models\LoanField;

final class FetchDownloadData
{
    public function handle(): array
    {
        return [
            'clients' => Client::query()->get(),
            'loanFields' => LoanField::query()->get(),
        ];
    }
}
