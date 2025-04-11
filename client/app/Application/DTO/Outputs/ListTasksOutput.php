<?php

namespace App\Application\DTO\Outputs;

class ListTasksOutput
{
    /**
     * @param ShowTaskOutput[]|null $tasks
     */
    public function __construct(
        public ?array $tasks = null,
    ) {
    }
}
