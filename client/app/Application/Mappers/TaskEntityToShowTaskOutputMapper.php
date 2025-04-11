<?php

namespace App\Application\Mappers;

use App\Application\DTO\Outputs\ShowTaskOutput;
use App\Domain\Entities\TaskEntity;

class TaskEntityToShowTaskOutputMapper
{
    public function map(TaskEntity $task): ShowTaskOutput
    {
        return new ShowTaskOutput(
            id: $task->getId(),
            title: $task->getTitle(),
            description: $task->getDescription(),
            status: $task->getStatus()?->value,
            importance: $task->getImportance(),
            deadline: $task->getDeadline(),
            createdAt: $task->getCreatedAt(),
            updatedAt: $task->getUpdatedAt(),
        );
    }
}
