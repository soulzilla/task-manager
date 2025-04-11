<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CreateTaskRequest",
    description: "Запрос на создание задачи",
    type: "object"
)]
class CreateTaskRequest extends FormRequest
{
    #[OA\Property(
        description: "Название задачи",
        type: "string",
        example: "Завершить проект"
    )]
    public string $title;

    #[OA\Property(
        description: "Описание задачи",
        type: "string",
        example: "Необходимо завершить проект до конца месяца"
    )]
    public string $description;

    #[OA\Property(
        description: "Статус задачи",
        type: "string",
        example: "todo",
        nullable: true
    )]
    public ?string $status;

    #[OA\Property(
        description: "Важность задачи (1-5)",
        type: "integer",
        example: 3
    )]
    public int $importance;

    #[OA\Property(
        description: "Крайний срок выполнения задачи (Unix Timestamp)",
        type: "string",
        format: "timestamp",
        example: "1697040000"
    )]
    public string $deadline;

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
            'deadline' => ['required', 'date_format:U'],
        ];
    }
}
