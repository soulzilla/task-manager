<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Collections\TasksCollection;
use App\Domain\Criteria\TasksCriteria;
use App\Domain\Entities\TaskEntity;
use App\Domain\Repositories\TasksRepositoryInterface;
use App\Infrastructure\Persistence\Mappers\TaskEntityToTaskModelMapper;
use App\Infrastructure\Persistence\Mappers\TaskModelToTaskEntityMapper;
use App\Infrastructure\Persistence\Models\Task;

class TasksRepository implements TasksRepositoryInterface
{
    public function createTask(TaskEntity $task): void
    {
        $mapper = new TaskEntityToTaskModelMapper();
        $model = $mapper->map($task);
        $model->save();
    }

    public function updateTask(TaskEntity $task): void
    {
        $model = Task::query()->find($task->getId());
        $mapper = new TaskEntityToTaskModelMapper();
        $model = $mapper->map($task, $model);
        $model->save();
    }

    public function deleteTask(TaskEntity $task): void
    {
        $model = Task::query()->find($task->getId());
        if ($model) {
            $model->delete();
        }
    }

    public function getTaskById(int $id): ?TaskEntity
    {
        $model = Task::query()->find($id);
        if ($model) {
            return (new TaskModelToTaskEntityMapper())->map($model);
        }
        return null;
    }

    public function getAllTasks(TasksCriteria $tasksCriteria): TasksCollection
    {
        $query = Task::query();

        if ($tasksCriteria->getStatus() !== null) {
            $query->where('status', $tasksCriteria->getStatus());
        }

        $models = $query->get();
        return new TasksCollection($models->map(static fn($model) => (new TaskModelToTaskEntityMapper())->map($model))->toArray());
    }
}
