<?php

namespace App\Presentation\Http\Responses\Tasks;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ListTasksResponse",
    properties: [
        new OA\Property(
            property: "tasks",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/ShowTaskResponse")
        )
    ],
    type: "object"
)]
readonly class ListTasksResponse implements \JsonSerializable
{
    public function __construct(
        private array $tasks,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'tasks' => $this->tasks,
        ];
    }
}
