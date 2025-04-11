<?php

namespace App\Application\Exceptions;

class TaskNotFoundException extends \LogicException
{
    private string $error_code = 'task_not_found';

    public function __construct(int $id)
    {
        parent::__construct("Task with ID {$id} not found.");
    }

    public function getErrorCode(): string
    {
        return $this->error_code;
    }
}
