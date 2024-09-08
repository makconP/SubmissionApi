<?php

namespace App\Services;

use App\Events\SubmissionSavedEvent;
use App\Jobs\CreateSubmissionJob;
use App\Models\Submission;
use App\Services\Contracts\SubmissionServiceInterface;
use App\Services\DTO\CreateSubmissionDTO;

class SubmissionService implements SubmissionServiceInterface
{
    public function createSubmissionInJob(CreateSubmissionDTO $createSubmissionDTO): void
    {
        CreateSubmissionJob::dispatch($createSubmissionDTO);
    }

    public function createSubmission(CreateSubmissionDTO $createSubmissionDTO): void
    {
        $createdSubmission = Submission::query()->create([
            'name' => $createSubmissionDTO->getName(),
            'email' => $createSubmissionDTO->getEmail(),
            'message' => $createSubmissionDTO->getMessage(),
        ]);

        SubmissionSavedEvent::dispatch($createdSubmission);
    }
}
