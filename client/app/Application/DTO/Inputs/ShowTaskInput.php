<?php

namespace App\Application\DTO\Inputs;

class ShowTaskInput
{
    public function __construct(
        public int $id,
    ) {
    }
}
