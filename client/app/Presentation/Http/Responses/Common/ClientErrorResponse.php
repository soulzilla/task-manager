<?php

namespace App\Presentation\Http\Responses\Common;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ClientErrorResponse",
    title: "ClientErrorResponse",
    description: "Клиентская ошибка",
    properties: [
        new OA\Property(property: "error", type: "string", example: "Task with ID `id` not found"),
        new OA\Property(property: "error_code", type: "string", example: "task_not_found")
    ],
    type: "object"
)]
class ClientErrorResponse
{

}
