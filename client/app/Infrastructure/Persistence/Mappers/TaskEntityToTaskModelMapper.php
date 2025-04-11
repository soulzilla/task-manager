<?php

namespace App\Infrastructure\Persistence\Mappers;

use App\Domain\Entities\TaskEntity;
use App\Infrastructure\Persistence\Models\Task;

class TaskEntityToTaskModelMapper
{
    public function map(TaskEntity $entity, ?Task $model = null): Task
    {
        if ($model === null) {
            $model = new Task();
        }
        $model->title = $entity->getTitle();
        $model->description = $entity->getDescription();
        $model->status = $entity->getStatus()?->value;
        $model->importance = $entity->getImportance();
        $model->deadline = $entity->getDeadline();

        return $model;
    }
}
