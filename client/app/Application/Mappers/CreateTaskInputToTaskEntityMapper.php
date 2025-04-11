<?php

namespace App\Application\Mappers;

use App\Application\DTO\Inputs\CreateTaskInput;
use App\Domain\Entities\TaskEntity;
use App\Domain\Enums\TaskStatus;

class CreateTaskInputToTaskEntityMapper
{
    public function map(CreateTaskInput $input): TaskEntity
    {
        $status = TaskStatus::tryFrom($input->status);

        return new TaskEntity(
            title: $input->title,
            description: $input->description,
            status: $status,
            importance: $input->importance,
            deadline: $input->deadline,
        );
    }
}
