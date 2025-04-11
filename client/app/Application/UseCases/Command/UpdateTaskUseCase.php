<?php

namespace App\Application\UseCases\Command;

use App\Application\DTO\Common\Outputs\EmptyOutput;
use App\Application\DTO\Inputs\UpdateTaskInput;
use App\Application\Exceptions\TaskNotFoundException;
use App\Domain\Enums\TaskStatus;
use App\Domain\Repositories\TasksRepositoryInterface;
use App\Domain\Services\TasksService;

readonly class UpdateTaskUseCase
{
    public function __construct(
        private TasksService $tasksService,
        private TasksRepositoryInterface $tasksRepository
    ) {
    }

    public function handle(UpdateTaskInput $input): EmptyOutput
    {
        $task = $this->tasksRepository->getTaskById($input->id);

        if ($task === null) {
            throw new TaskNotFoundException($input->id);
        }

        $status = $input->status ? TaskStatus::tryFrom($input->status) : null;

        $this->tasksService->updateTask(
            task: $task,
            title: $input->title,
            description: $input->description,
            status: $status,
            importance: $input->importance,
            deadline: $input->deadline,
        );

        $this->tasksRepository->updateTask($task);

        return new EmptyOutput();
    }
}
