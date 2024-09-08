<?php

namespace Tests\Unit\Jobs;

use App\Events\SubmissionSavedEvent;
use App\Jobs\CreateSubmissionJob;
use App\Services\Contracts\SubmissionServiceInterface;
use App\Services\DTO\CreateSubmissionDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateSubmissionJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_handle(): void
    {
        Event::fake();
        $createSubmissionDTO = new CreateSubmissionDTO(
            'John Doe',
            'john.doe@example.com',
            'This is a test message.',
        );

        $submissionService = app(SubmissionServiceInterface::class);

        (new CreateSubmissionJob($createSubmissionDTO))
            ->handle($submissionService);

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        Event::assertDispatched(SubmissionSavedEvent::class);
    }
}
