<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskRequest',
    description: 'Схема для создания задачи',
    required: ['title', 'description', 'status', 'importance', 'deadline'],
    properties: [
        new OA\Property(property: 'title', type: 'string', example: 'Подготовить презентацию'),
        new OA\Property(property: 'description', type: 'string', example: 'Описание задачи'),
        new OA\Property(property: 'status', type: 'string', enum: ['todo', 'in_progress', 'completed'], example: 'todo'),
        new OA\Property(property: 'importance', type: 'integer', example: 5),
        new OA\Property(property: 'deadline', type: 'string', format: 'date-time', example: '2025-12-01 12:00:00'),
    ]
)]
class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => Rule::enum(TaskStatus::class),
            'importance' => 'required|integer|min:1|max:5',
            'deadline' => 'required|date|after:now',
        ];
    }
}
