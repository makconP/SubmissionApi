<?php

namespace App\Services\Contracts;

use App\Services\DTO\CreateSubmissionDTO;

interface SubmissionServiceInterface
{
    public function createSubmissionInJob(CreateSubmissionDTO $createSubmissionDTO): void;

    public function createSubmission(CreateSubmissionDTO $createSubmissionDTO): void;
}
