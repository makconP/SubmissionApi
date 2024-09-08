<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionStoreRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\Contracts\SubmissionServiceInterface;
use App\Services\DTO\CreateSubmissionDTO;

class SubmissionController extends Controller
{
    public function __construct(private readonly SubmissionServiceInterface $submissionService) {}

    public function store(SubmissionStoreRequest $submissionStoreRequest): ApiSuccessResponse
    {
        $createSubmissionDTO = new CreateSubmissionDTO(
            $submissionStoreRequest->getName(),
            $submissionStoreRequest->getEmail(),
            $submissionStoreRequest->getMessage(),
        );

        $this->submissionService->createSubmissionInJob($createSubmissionDTO);

        return new ApiSuccessResponse;
    }
}
