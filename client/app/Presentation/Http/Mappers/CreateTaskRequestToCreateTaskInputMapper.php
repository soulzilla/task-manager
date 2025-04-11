<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\CreateTaskInput;
use App\Presentation\Http\Requests\Tasks\CreateTaskRequest;

class CreateTaskRequestToCreateTaskInputMapper
{
    public function map(CreateTaskRequest $request): CreateTaskInput
    {
        return new CreateTaskInput(
            title: $request->getTitle(),
            description: $request->getDescription(),
            status: $request->getStatus(),
            importance: $request->getImportance(),
            deadline: $request->getDeadline(),
        );
    }
}
