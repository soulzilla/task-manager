<?php

namespace App\Presentation\Http\Responses\Tasks;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CreateTaskResponse",
    description: "Ответ на успешное создание задачи. Тело ответа пустое.",
    type: "object"
)]
class CreateTaskResponse implements \JsonSerializable
{
    public function jsonSerialize(): ?array
    {
        return null;
    }
}
