<?php

namespace App\Application\UseCases\Query;

use App\Application\DTO\Inputs\ShowTaskInput;
use App\Application\DTO\Outputs\ShowTaskOutput;
use App\Application\Exceptions\TaskNotFoundException;
use App\Application\Mappers\TaskEntityToShowTaskOutputMapper;
use App\Domain\Repositories\TasksRepositoryInterface;

readonly class ShowTaskUseCase
{
    public function __construct(
        private TasksRepositoryInterface $tasksRepository
    ) {
    }

    public function handle(ShowTaskInput $input): ShowTaskOutput
    {
        $task = $this->tasksRepository->getTaskById($input->id);

        if ($task === null) {
            throw new TaskNotFoundException($input->id);
        }

        $mapper = new TaskEntityToShowTaskOutputMapper();
        return $mapper->map($task);
    }
}
