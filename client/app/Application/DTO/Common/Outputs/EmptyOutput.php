<?php

namespace App\Application\DTO\Common\Outputs;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "EmptyOutput",
    description: "Пустой ответ",
    type: "object"
)]
class EmptyOutput
{

}
