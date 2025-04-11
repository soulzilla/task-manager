<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UpdateTaskRequest",
    description: "Запрос на обновление задачи",
    required: ["title", "description", "importance", "deadline"],
    properties: [
        new OA\Property(
            property: "title",
            description: "Название задачи",
            type: "string",
            example: "Обновить документацию"
        ),
        new OA\Property(
            property: "description",
            description: "Описание задачи",
            type: "string",
            example: "Необходимо обновить документацию для API"
        ),
        new OA\Property(
            property: "status",
            description: "Статус задачи",
            type: "string",
            enum: ["todo", "in_progress", "completed"],
            example: "todo"
        ),
        new OA\Property(property: "importance", description: "Важность задачи (1-5)", type: "integer", example: 3),
        new OA\Property(
            property: "deadline",
            description: "Дедлайн задачи в формате Unix-времени",
            type: "string",
            example: "2025-12-31 23:59:59"
        ),
    ],
    type: "object"
)]
class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:todo,in_progress,done'],
            'importance' => ['required', 'integer', 'between:1,5'],
            'deadline' => ['required', 'date_format:U'],
        ];
    }

    public function getTaskId(): int
    {
        return (int) $this->route('id');
    }
}
