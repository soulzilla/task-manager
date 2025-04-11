<?php

namespace App\Application\UseCases\Query;

use App\Application\DTO\Inputs\ListTasksInput;
use App\Application\DTO\Outputs\ListTasksOutput;
use App\Application\Mappers\TaskEntityToShowTaskOutputMapper;
use App\Domain\Criteria\TasksCriteria;
use App\Domain\Enums\TaskStatus;
use App\Domain\Repositories\TasksRepositoryInterface;

readonly class ListTasksUseCase
{
    public function __construct(
        private TasksRepositoryInterface $tasksRepository,
    ) {
    }

    public function handle(ListTasksInput $input): ListTasksOutput
    {
        $status = $input->status ? TaskStatus::tryFrom($input->status) : null;
        $criteria = new TasksCriteria(
            status: $status,
        );

        $tasks_collection = $this->tasksRepository->getAllTasks($criteria);

        if ($tasks_collection->isEmpty()) {
            return new ListTasksOutput();
        }

        $tasks = [];

        $mapper = new TaskEntityToShowTaskOutputMapper();
        foreach ($tasks_collection as $task) {
            $tasks[] = $mapper->map($task);
        }

        return new ListTasksOutput(
            tasks: $tasks,
        );
    }
}
