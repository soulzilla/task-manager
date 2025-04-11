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
    public function authorize(): bool
    {
        return true;
    }

    public function getTaskId(): int
    {
        return (int) $this->route('id');
    }
}
