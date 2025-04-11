<?php

namespace App\Presentation\Http\Responses\Common;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ServerErrorResponse",
    title: "ServerErrorResponse",
    description: "Клиентская ошибка",
    properties: [
        new OA\Property(property: "error", type: "string", example: "Houston, we have a problem")
    ],
    type: "object"
)]
class ServerErrorResponse
{

}
