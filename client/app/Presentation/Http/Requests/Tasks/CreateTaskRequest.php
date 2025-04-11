<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CreateTaskRequest",
    description: "Запрос на создание задачи",
    required: ["title", "description", "importance", "deadline"],
    properties: [
        new OA\Property(
            property: "title",
            description: "Описание задачи",
            type: "string",
            example: "Подготовить презентацию"
        ),
        new OA\Property(
            property: "description",
            description: "Описание задачи",
            type: "string",
            example: "Подготовить презентацию для заказчика"
        ),
        new OA\Property(
            property: "status",
            description: "Статус задачи",
            type: "string",
            enum: ["todo", "in_progress", "completed"],
            example: "todo"
        ),
        new OA\Property(
            property: "importance",
            description: "Важность задачи (1-5)",
            type: "integer",
            example: 4
        ),
        new OA\Property(
            property: "deadline",
            description: "Крайний срок выполнения задачи",
            type: "string",
            format: "timestamp",
            example: "2024-12-01 12:00:00",
        ),
    ],
    type: "object"
)]
class CreateTaskRequest extends FormRequest
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
            'status' => ['nullable', 'string', 'in:todo,in_progress,completed'],
            'importance' => ['required', 'integer', 'between:1,5'],
            'deadline' => ['required', 'date'],
        ];
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getDescription(): string
    {
        return $this->input('description');
    }

    public function getStatus(): ?string
    {
        return $this->input('status');
    }

    public function getImportance(): int
    {
        return (int) $this->input('importance');
    }

    public function getDeadline(): string
    {
        return $this->input('deadline');
    }
}
