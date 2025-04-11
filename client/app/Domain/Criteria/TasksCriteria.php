<?php

namespace App\Domain\Criteria;

use App\Domain\Enums\TaskStatus;

readonly class TasksCriteria
{
    public function __construct(
        private ?TaskStatus $status = null
    ) {
    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }
}
