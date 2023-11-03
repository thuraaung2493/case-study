<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'loanInfo' => $this->loan_info,
            'clientInfo' => $this->client_info,
            'personalDetail' => $this->personal_detail,
            'householdDetail' => $this->household_detail,
            'businessProfile' => $this->business_profile,
            'approvalStatus' => $this->approval_status->value,
        ];
    }
}
