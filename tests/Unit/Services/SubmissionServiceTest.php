<?php

namespace Tests\Unit\Services;

use App\Events\SubmissionSavedEvent;
use App\Jobs\CreateSubmissionJob;
use App\Services\DTO\CreateSubmissionDTO;
use App\Services\SubmissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_submission_in_job(): void
    {
        Queue::fake();

        /**
         * @var SubmissionService $submissionService
         */
        $submissionService = app(SubmissionService::class);

        $createSubmissionDTO = new CreateSubmissionDTO(
            'John Doe',
            'john.doe@example.com',
            'This is a test message.',
        );

        $submissionService->createSubmissionInJob($createSubmissionDTO);

        Queue::assertPushed(CreateSubmissionJob::class);
    }

    public function test_create_submission(): void
    {
        Event::fake();

        /**
         * @var SubmissionService $submissionService
         */
        $submissionService = app(SubmissionService::class);

        $createSubmissionDTO = new CreateSubmissionDTO(
            'John Doe',
            'john.doe@example.com',
            'This is a test message.',
        );

        $submissionService->createSubmission($createSubmissionDTO);

        Event::assertDispatched(SubmissionSavedEvent::class);

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);
    }
}
