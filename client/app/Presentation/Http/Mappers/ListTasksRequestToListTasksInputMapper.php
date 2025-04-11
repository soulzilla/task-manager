<?php

namespace App\Presentation\Http\Mappers;

use App\Application\DTO\Inputs\ListTasksInput;
use App\Presentation\Http\Requests\Tasks\ListTasksRequest;

class ListTasksRequestToListTasksInputMapper
{
    public function map(ListTasksRequest $request): ListTasksInput
    {
        return new ListTasksInput(
            status: $request->getStatus(),
        );
    }
}
