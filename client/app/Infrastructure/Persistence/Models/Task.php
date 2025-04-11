<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property int $importance
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'importance',
        'deadline',
    ];
}
