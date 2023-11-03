<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DownloadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->resource);
        return [
            'clients' => ClientResource::collection($this->resource['clients']),
            'interviews' => LoanFieldResource::collection($this->resource['loanFields']),
        ];
    }
}
