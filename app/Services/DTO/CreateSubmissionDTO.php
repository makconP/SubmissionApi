<?php

namespace App\Services\DTO;

final readonly class CreateSubmissionDTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $message
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
