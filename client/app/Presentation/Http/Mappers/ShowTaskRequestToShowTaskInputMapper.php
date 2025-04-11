<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\ShowTaskInput;
use App\Presentation\Http\Requests\Tasks\ShowTaskRequest;

class ShowTaskRequestToShowTaskInputMapper
{
    public function map(ShowTaskRequest $request): ShowTaskInput
    {
        return new ShowTaskInput(
            id: $request->getTaskId()
        );
    }
}
