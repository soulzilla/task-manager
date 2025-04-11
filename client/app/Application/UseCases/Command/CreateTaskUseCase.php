<?php

namespace App\Application\UseCases\Command;

use App\Application\DTO\Common\Outputs\EmptyOutput;
use App\Application\DTO\Inputs\CreateTaskInput;
use App\Application\Mappers\CreateTaskInputToTaskEntityMapper;
use App\Domain\Repositories\TasksRepositoryInterface;
use App\Domain\Services\TasksService;

readonly class CreateTaskUseCase
{
    public function __construct(
        private TasksService $tasksService,
        private TasksRepositoryInterface $tasksRepository
    ) {
    }

    public function handle(CreateTaskInput $input): EmptyOutput
    {
        $mapper = new CreateTaskInputToTaskEntityMapper();
        $task = $mapper->map($input);

        if ($task->getStatus() === null) {
            $this->tasksService->loadDefaultStatus($task);
        }

        $this->tasksRepository->createTask($task);

        return new EmptyOutput();
    }
}
