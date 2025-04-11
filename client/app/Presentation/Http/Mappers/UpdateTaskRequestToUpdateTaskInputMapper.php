<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\UpdateTaskInput;
use App\Presentation\Http\Requests\Tasks\UpdateTaskRequest;

class UpdateTaskRequestToUpdateTaskInputMapper
{
    public function map(UpdateTaskRequest $request): UpdateTaskInput
    {
        return new UpdateTaskInput(
            id: $request->getTaskId(),
            title: $request->title,
            description: $request->description,
            status: $request->status,
            importance: $request->importance,
            deadline: $request->deadline,
        );
    }
}
