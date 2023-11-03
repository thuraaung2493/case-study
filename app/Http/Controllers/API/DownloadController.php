<?php

namespace App\Http\Controllers\API;

use App\Actions\FetchDownloadData;
use App\Http\Resources\DownloadResource;
use App\Http\Responses\API\SuccessResponse;

final class DownloadController
{
    public function __construct(
        private FetchDownloadData $fetchDownloadData,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $data = $this->fetchDownloadData->handle();

        return new SuccessResponse(
            new DownloadResource($data),
        );
    }
}
