<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\CreateTaskInput;
use App\Presentation\Http\Requests\Tasks\CreateTaskRequest;

class CreateTaskRequestToCreateTaskInputMapper
{
    public function map(CreateTaskRequest $request): CreateTaskInput
    {
        return new CreateTaskInput(
            title: $request->title,
            description: $request->description,
            status: $request->status,
            importance: $request->importance,
            deadline: $request->deadline,
        );
    }
}
