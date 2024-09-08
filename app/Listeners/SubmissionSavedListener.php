<?php

namespace App\Listeners;

use App\Events\SubmissionSavedEvent;
use Psr\Log\LoggerInterface;

class SubmissionSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly LoggerInterface $logger) {}

    /**
     * Handle the event.
     */
    public function handle(SubmissionSavedEvent $event): void
    {
        $this->logger->info('Submission saved successfully.', [
            'name' => $event->submission->name,
            'email' => $event->submission->email,
        ]);
    }
}
