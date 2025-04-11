<?php

namespace App\Presentation\Http\Responses\Tasks;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "ListTasksByPriorityResponse",
    description: "Список задач с приоритетом",
    properties: [
        new OA\Property(
            property: "data",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(property: "id", type: "integer", example: 1),
                    new OA\Property(property: "title", type: "string", example: "Task title"),
                    new OA\Property(property: "description", type: "string", example: "Task description"),
                    new OA\Property(property: "status", type: "string", enum: ["todo", "in_progress", "completed"], example: "completed"),
                    new OA\Property(property: "importance", type: "integer", example: 1),
                    new OA\Property(property: "deadline", type: "string", example: "2023-10-01 12:00:00"),
                    new OA\Property(property: "is_overdue", type: "boolean", example: false),
                    new OA\Property(property: "priority_score", type: "integer", example: 5),
                    new OA\Property(property: "created_at", type: "string", example: "2023-10-01 12:00:00"),
                    new OA\Property(property: "updated_at", type: "string", example: "2023-10-01 12:00:00"),
                ],
                type: "object"
            )
        )
    ]
)]
readonly class ListTasksByPriorityResponse implements \JsonSerializable
{
    public function __construct(
        private array $tasks
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'data' => $this->tasks,
        ];
    }
}
