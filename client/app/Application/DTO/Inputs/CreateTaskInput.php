<?php

namespace App\Application\DTO\Inputs;

class CreateTaskInput
{
    public function __construct(
        public string $title,
        public string $description,
        public ?string $status = null,
        public int $importance,
        public string $deadline,
    ) {
    }
}
