<?php

namespace App\Presentation\Http\Controllers;

use OpenApi\Attributes as OA;

define('APP_URL', env('APP_URL') . '/api/v1');
#[OA\OpenApi(
    info: new OA\Info(
        version: 'v1',
        title: 'Task Manager API',
    ),
    servers: [
        new OA\Server(url: APP_URL)
    ]
)]
abstract class Controller
{

}
