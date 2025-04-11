<?php

namespace App\Application\UseCases\Query;

use App\Application\DTO\Inputs\ListTasksInput;
use App\Application\DTO\Outputs\ListTasksByPriorityOutput;
use App\Application\Mappers\TasksCollectionToListTasksByPriorityOutputMapper;
use App\Application\Services\TasksPrioritizationService;
use App\Domain\Criteria\TasksCriteria;
use App\Domain\Enums\TaskStatus;
use App\Domain\Repositories\TasksRepositoryInterface;

class ListTasksByPriorityUseCase
{
    public function __construct(
        private TasksRepositoryInterface $tasksRepository,
        private TasksPrioritizationService $tasksPrioritizationService
    ) {
    }

    public function handle(ListTasksInput $input): ListTasksByPriorityOutput
    {
        $status = $input->status ? TaskStatus::tryFrom($input->status) : null;
        $criteria = new TasksCriteria(
            status: $status
        );

        $tasks = $this->tasksRepository->getAllTasks($criteria);

        if ($tasks->isEmpty()) {
            return new ListTasksByPriorityOutput();
        }

        $this->tasksPrioritizationService->prioritizeTasks($tasks);

        return (new TasksCollectionToListTasksByPriorityOutputMapper())->map($tasks);
    }
}
