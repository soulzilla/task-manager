<?php

namespace App\Presentation\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class ListTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'nullable|string|in:todo,in_progress,completed',
        ];
    }

    public function getStatus(): ?string
    {
        return $this->get('status');
    }
}
