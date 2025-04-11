<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "DeleteTaskRequest",
    description: "Запрос на удаление задачи",
    type: "object"
)]
class DeleteTaskRequest extends FormRequest
{
    #[OA\Parameter(
        parameter: "DeleteTaskRequest_id",
        name: "id",
        description: "Идентификатор задачи для удаления",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer", example: 1)
    )]
    public int $id;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tasks,id',
        ];
    }

    public function getTaskId(): int
    {
        return (int) $this->route('id');
    }
}
