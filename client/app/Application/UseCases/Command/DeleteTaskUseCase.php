<?php

namespace App\Application\UseCases\Command;

use App\Application\DTO\Common\Outputs\EmptyOutput;
use App\Application\DTO\Inputs\DeleteTaskInput;
use App\Application\Exceptions\TaskNotFoundException;
use App\Domain\Repositories\TasksRepositoryInterface;

readonly class DeleteTaskUseCase
{
    public function __construct(
        private TasksRepositoryInterface $tasksRepository,
    ) {
    }

    public function handle(DeleteTaskInput $input): EmptyOutput
    {
        $task = $this->tasksRepository->getTaskById($input->id);

        if ($task === null) {
            throw new TaskNotFoundException($input->id);
        }

        $this->tasksRepository->deleteTask($task);

        return new EmptyOutput();
    }
}
