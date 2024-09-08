<?php

namespace App\Jobs;

use App\Services\Contracts\SubmissionServiceInterface;
use App\Services\DTO\CreateSubmissionDTO;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateSubmissionJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly CreateSubmissionDTO $createSubmissionDTO,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(SubmissionServiceInterface $submissionService): void
    {
        $submissionService->createSubmission($this->createSubmissionDTO);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Log::error('Submission creation in job failed.', [
            'exception' => $exception->getMessage(),
            'submission_data' => [
                'name' => $this->createSubmissionDTO->getName(),
                'email' => $this->createSubmissionDTO->getEmail(),
                'message' => $this->createSubmissionDTO->getMessage(),
            ],
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}
