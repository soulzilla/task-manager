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
        ?TaskStatus $status = null,
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

    public function calculatePriorityScore(TaskEntity $task): void
    {
        $priorityScore = 0.0;

        if ($task->getStatus() && $task->getStatus() === TaskStatus::COMPLETED) {
            $task->setPriorityScore($priorityScore);
            return;
        }

        if ($task->getDeadline() && $task->getDeadline() < date('Y-m-d H:i:s')) {
            $task->setIsOverdue(true);
            return;
        }

        $daysUntilDeadline = (strtotime($task->getDeadline()) - time()) / (60 * 60 * 24);

        $priorityScore = $task->getImportance() * (1/$daysUntilDeadline);
        $priorityScore = round($priorityScore, 2);
        $task->setPriorityScore($priorityScore);
    }
}
