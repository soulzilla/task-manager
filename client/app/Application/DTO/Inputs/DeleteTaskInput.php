<?php

namespace App\Application\DTO\Inputs;

class DeleteTaskInput
{
    public function __construct(
        public int $id,
    ) {
    }
}
