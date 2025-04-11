<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;

use App\Application\UseCases\Query\ListTasksUseCase;
use App\Presentation\Http\Mappers\ListTasksRequestToListTasksInputMapper;
use App\Presentation\Http\Requests\Tasks\ListTasksRequest;
use App\Presentation\Http\Responses\Tasks\ListTasksResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/tasks",
    operationId: "listTasks",
    description: "Получить список задач",
    summary: "Список задач",
    tags: ["tasks"],
    parameters: [
        new OA\Parameter(
            name: "status",
            description: "Статус задачи",
            in: "query",
            required: false,
            schema: new OA\Schema(type: "string", enum: ["todo", "in_progress", "completed"], example: "completed"),
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успешно получен список задач",
            content: new OA\JsonContent(ref: "#/components/schemas/ListTasksResponse")
        ),
        new OA\Response(
            response: 400,
            description: "Клиентская ошибка",
            content: new OA\JsonContent(ref: "#/components/schemas/ClientErrorResponse")
        ),
        new OA\Response(
            response: 500,
            description: "Внутренняя ошибка сервера",
            content: new OA\JsonContent(ref: "#/components/schemas/ServerErrorResponse")
        ),
    ]
)]
readonly class ListTasksController
{
    public function __construct(
        private ListTasksUseCase $listTasksUseCase,
        private ListTasksRequestToListTasksInputMapper $listTasksRequestToListTasksInputMapper,
    ) {
    }

    public function __invoke(ListTasksRequest $request): ListTasksResponse
    {
        $tasks = $this->listTasksUseCase->handle(
            $this->listTasksRequestToListTasksInputMapper->map($request)
        );

        return new ListTasksResponse($tasks->tasks);
    }
}
