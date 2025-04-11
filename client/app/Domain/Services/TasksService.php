<?php

namespace App\Domain\Services;

use App\Domain\Entities\TaskEntity;
use App\Domain\Enums\TaskStatus;

class TasksService
{
    public function updateTask(
        TaskEntity $task,
        ?string $title = null,
        ?string $description = null,
        TaskStatus $status = null,
        ?int $importance = null,
        ?string $deadline = null
    ): void
    {
        if ($title && $title !== $task->getTitle()) {
            $task->setTitle($title);
        }

        if ($description && $description !== $task->getDescription()) {
            $task->setDescription($description);
        }

        if ($status && $status !== $task->getStatus()) {
            $task->setStatus($status);
        }

        if ($importance && $importance !== $task->getImportance()) {
            $task->setImportance($importance);
        }

        if ($deadline && $deadline !== $task->getDeadline()) {
            $task->setDeadline($deadline);
        }
    }

    public function loadDefaultStatus(TaskEntity $task): void
    {
        if ($task->getStatus() === null) {
            $task->setStatus(TaskStatus::TODO);
        }
    }
}
