<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\DeleteTaskInput;
use App\Presentation\Http\Requests\Tasks\DeleteTaskRequest;

class DeleteTaskRequestToDeleteTaskInputMapper
{
    public function map(DeleteTaskRequest $request): DeleteTaskInput
    {
        return new DeleteTaskInput(
            id: $request->getTaskId(),
        );
    }
}
