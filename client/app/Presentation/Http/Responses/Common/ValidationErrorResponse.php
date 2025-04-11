<?php

namespace App\Presentation\Http\Responses\Common;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ValidationErrorResponse",
    title: "ValidationErrorResponse",
    description: "Ошибка валидации",
    properties: [
        new OA\Property(property: "errors", type: "array", items: new OA\Items(type: "string"))
    ],
    type: "object"
)]
class ValidationErrorResponse
{

}
