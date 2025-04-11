<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class ShowTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }

    public function getTaskId(): int
    {
        return (int) $this->route('id');
    }
}
