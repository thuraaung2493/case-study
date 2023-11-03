<?php

namespace App\Jobs;

use ZipArchive;
use App\Models\Client;
use App\Models\LoanField;
use App\Enums\ApprovalStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessDataImport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $path,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $extractPath = $this->unzip($this->path);

        $jsonData = $this->getJsonData($extractPath);

        if (\count($jsonData) === 0) {
            return;
        }

        $this->createClients($jsonData['clients']);

        $this->upsertLoanFields($jsonData['interviews']);
    }

    private function upsertLoanFields(array|null $data): void
    {
        if ($data) {
            // Create New Loan Fields
            \collect($data)
                ->filter(fn ($interview) => $interview['approvalStatus'] === ApprovalStatus::PENDING->value)
                ->each(function ($interview) {
                    LoanField::query()->create([
                        'loan_info' => $interview['loanInfo'],
                        'client_info' => $interview['clientInfo'],
                        'personal_detail' => $interview['personalDetail'],
                        'household_detail' => $interview['householdDetail'],
                        'business_profile' => $interview['businessProfile'],
                        'approval_status' => $interview['approvalStatus'],
                    ]);
                });

            // Update
            \collect($data)
                ->filter(fn ($interview) => $interview['approvalStatus'] === ApprovalStatus::UPDATED->value)
                ->each(function ($interview) {
                    LoanField::query()->where('id', $interview['id'])->update([
                        'loan_info' => $interview['loanInfo'],
                        'client_info' => $interview['clientInfo'],
                        'personal_detail' => $interview['personalDetail'],
                        'household_detail' => $interview['householdDetail'],
                        'business_profile' => $interview['businessProfile'],
                        'approval_status' => $interview['approvalStatus'],
                    ]);
                });
        }
    }

    private function createClients(array|null $data): void
    {
        if ($data) {
            $clients = \collect($data)
                ->map(fn ($client) => [
                    'name' => $client['name'],
                    'phone_number' => $client['phone'],
                    'nrc_number' => $client['nrc'],
                    'address' => $client['address'],
                ])->toArray();

            Client::query()->upsert($clients, ['nrc_number']);
        }
    }

    private function getJsonData(string|null $extractPath): array
    {
        if (\is_null($extractPath)) {
            return [];
        }

        $extractedFilePath = $extractPath . '/data.json';
        $contents = File::get($extractedFilePath);

        if (\is_dir($extractPath)) {
            \unlink($extractedFilePath);
            \rmdir($extractPath);
        }

        return \json_decode($contents, true);
    }

    private function unzip(string $path): string|null
    {
        $zip = new ZipArchive();

        $zipPath = $zip->open(Storage::path($path));

        if ($zipPath !== TRUE) {
            return null;
        }

        $extractPath = public_path('extracts/') . \pathinfo($path, \PATHINFO_FILENAME);
        $zip->extractTo($extractPath);
        $zip->close();

        Storage::delete($path);

        return $extractPath;
    }
}
