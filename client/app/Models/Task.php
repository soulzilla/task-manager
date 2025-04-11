<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Task',
    description: 'Сущность задачи',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Подготовить презентацию'),
        new OA\Property(property: 'description', type: 'string', example: 'Описание задачи'),
        new OA\Property(property: 'status', type: 'string', enum: ['TODO', 'IN_PROGRESS', 'COMPLETED'], example: 'TODO'),
        new OA\Property(property: 'importance', type: 'integer', example: 5),
        new OA\Property(property: 'deadline', type: 'string', format: 'date-time', example: '2024-12-01T12:00:00Z'),
        new OA\Property(property: 'is_overdue', type: 'boolean', example: false),
        new OA\Property(property: 'priority_score', type: 'number', format: 'float', example: 0.0),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2024-11-25T10:00:00Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2024-11-25T10:00:00Z'),
    ],
    type: 'object'
)]
class Task extends Model
{
    use HasFactory;

    public $is_overdue = false;
    public $priority_score = 0.00 {
        set($value) {
            if (!$value) {
                $this->priority_score = 0.00;
                return;
            }
            $this->priority_score = round($value, 2);
        }
    }

    protected $fillable = [
        'title',
        'description',
        'status',
        'importance',
        'deadline',
    ];
}
