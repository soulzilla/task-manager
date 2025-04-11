<?php

namespace App\Application\DTO\Inputs;

class UpdateTaskInput
{
    public function __construct(
        public int $id,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $status = null,
        public ?int $importance = null,
        public ?string $deadline = null,
    ) {
    }
}
