<?php

namespace App\Application\DTO\Outputs;

class ListTasksByPriorityOutput
{
    /**
     * @param array|null $tasks
     */
    public function __construct(
        public ?array $tasks = null
    ) {
    }
}
