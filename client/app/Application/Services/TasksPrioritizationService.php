<?php

namespace App\Application\Services;

use App\Domain\Collections\TasksCollection;
use App\Domain\Entities\TaskEntity;
use App\Domain\Services\TasksService;

class TasksPrioritizationService
{
    public function __construct(
        private TasksService $tasksService
    ) {
    }

    public function prioritizeTasks(TasksCollection $tasks): void
    {
        /**
         * @var TaskEntity $task
         */
        foreach ($tasks as $task) {
            $this->tasksService->calculatePriorityScore($task);
        }

        $tasks->sortByPriorityScore();
    }
}
