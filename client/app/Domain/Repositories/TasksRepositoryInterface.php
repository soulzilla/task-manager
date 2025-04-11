<?php

namespace App\Domain\Repositories;

use App\Domain\Collections\TasksCollection;
use App\Domain\Criteria\TasksCriteria;
use App\Domain\Entities\TaskEntity;

interface TasksRepositoryInterface
{
    public function createTask(TaskEntity $task): void;

    public function updateTask(TaskEntity $task): void;

    public function deleteTask(TaskEntity $task): void;

    public function getTaskById(int $id): ?TaskEntity;

    public function getAllTasks(TasksCriteria $tasksCriteria): TasksCollection;
}
