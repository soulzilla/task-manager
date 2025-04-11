<?php

namespace App\Application\DTO\Outputs;

class ShowTaskOutput
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $status,
        public int $importance,
        public string $deadline,
        public string $createdAt,
        public string $updatedAt,
    ) {
    }
}
