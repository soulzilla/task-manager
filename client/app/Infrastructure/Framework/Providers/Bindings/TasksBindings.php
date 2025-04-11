<?php

namespace App\Infrastructure\Framework\Providers\Bindings;

use App\Domain\Repositories\TasksRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\TasksRepository;

class TasksBindings
{
    public static function boot(): array
    {
        return [
            TasksRepositoryInterface::class => TasksRepository::class,
        ];
    }
}
