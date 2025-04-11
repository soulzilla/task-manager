<?php

namespace App\Application\Mappers;

use App\Application\DTO\Outputs\ListTasksByPriorityOutput;
use App\Domain\Collections\TasksCollection;
use App\Domain\Entities\TaskEntity;

class TasksCollectionToListTasksByPriorityOutputMapper
{
    public function map(TasksCollection $collection): ListTasksByPriorityOutput
    {
        $tasks = [];

        /** @var TaskEntity $task */
        foreach ($collection as $task) {
            $tasks[] = [
                'id' => $task->getId(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus()?->value,
                'importance' => $task->getImportance(),
                'deadline' => $task->getDeadline(),
                'is_overdue' => $task->getIsOverdue(),
                'priority_score' => $task->getPriorityScore(),
                'created_at' => $task->getCreatedAt(),
                'updated_at' => $task->getUpdatedAt(),
            ];
        }

        return new ListTasksByPriorityOutput(
            tasks: $tasks,
        );
    }
}
