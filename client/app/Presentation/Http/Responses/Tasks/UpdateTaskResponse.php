<?php

namespace App\Presentation\Http\Responses\Tasks;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UpdateTaskResponse",
    description: "Ответ на успешное обновление задачи. Тело ответа пустое.",
    type: "object"
)]
class UpdateTaskResponse implements \JsonSerializable
{
    public function jsonSerialize(): ?array
    {
        return null;
    }
}
