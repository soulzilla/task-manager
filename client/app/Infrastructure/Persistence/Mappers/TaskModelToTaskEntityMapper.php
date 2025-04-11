<?php

namespace App\Infrastructure\Persistence\Mappers;

use App\Domain\Entities\TaskEntity;
use App\Domain\Enums\TaskStatus;
use App\Infrastructure\Persistence\Models\Task;

class TaskModelToTaskEntityMapper
{
    public function map(Task $model): TaskEntity
    {
        $status = TaskStatus::tryFrom($model->status);

        return new TaskEntity(
            id: $model->id,
            title: $model->title,
            description: $model->description,
            status: $status,
            importance: $model->importance,
            deadline: $model->deadline,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
        );
    }
}
