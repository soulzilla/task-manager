<?php

namespace App\Presentation\Http\Responses\Tasks;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceResponse;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "ShowTaskResponse",
    description: "Ответ на запрос получения задачи",
    properties: [
        new OA\Property(
            property: "id",
            description: "Идентификатор задачи",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "title",
            description: "Название задачи",
            type: "string",
            example: "Задача 1"
        ),
        new OA\Property(
            property: "description",
            description: "Описание задачи",
            type: "string",
            example: "Описание задачи 1"
        ),
        new OA\Property(
            property: "status",
            description: "Статус задачи",
            type: "string",
            example: "todo"
        ),
        new OA\Property(
            property: "importance",
            description: "Важность задачи",
            type: "integer",
            example: "3"
        ),
        new OA\Property(
            property: "deadline",
            description: "Срок выполнения задачи",
            type: "string",
            example: "2025-01-12 12:00:00",
        ),
        new OA\Property(
            property: "created_at",
            description: "Дата создания задачи",
            type: "string",
            example: "2023-10-01 12:00:00",
        ),
        new OA\Property(
            property: "updated_at",
            description: "Дата обновления задачи",
            type: "string",
            example: "2023-10-01 12:00:00",
        ),
    ]
)]
class ShowTaskResponse extends ResourceResponse
{
    public function toResponse($request): JsonResponse
    {
        return response()->json();
    }
}
