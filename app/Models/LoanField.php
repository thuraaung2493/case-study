<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanField extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'loan_info' => 'array',
        'client_info' => 'array',
        'personal_detail' => 'array',
        'household_detail' => 'array',
        'business_profile' => 'array',
        'approval_status' => ApprovalStatus::class,
    ];
}
