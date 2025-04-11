<?php

namespace App\Presentation\Http\Responses\Tasks;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "DeleteTaskResponse",
    description: "Ответ на успешное удаление задачи. Тело ответа пустое.",
    type: "object",
)]
class DeleteTaskResponse implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
