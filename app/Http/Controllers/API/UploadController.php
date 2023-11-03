<?php

namespace App\Http\Controllers\API;

use App\Enums\ApprovalStatus;
use App\Http\Controllers\Controller;
use App\Http\Responses\API\MessageOnlyResponse;
use App\Jobs\ProcessDataImport;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        ProcessDataImport::dispatch($request->file('zip')->store('zips'));

        return new MessageOnlyResponse('Success upload.');
    }
}
