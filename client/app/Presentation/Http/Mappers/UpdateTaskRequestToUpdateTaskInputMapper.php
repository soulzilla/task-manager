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
            title: $request->getTitle(),
            description: $request->getDescription(),
            status: $request->getStatus(),
            importance: $request->getImportance(),
            deadline: $request->getDeadline(),
        );
    }
}
