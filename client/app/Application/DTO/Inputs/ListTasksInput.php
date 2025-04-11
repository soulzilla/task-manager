<?php

namespace App\Application\DTO\Inputs;

readonly class ListTasksInput
{
    public function __construct(
        public ?string $status = null,
    ) {
    }
}
