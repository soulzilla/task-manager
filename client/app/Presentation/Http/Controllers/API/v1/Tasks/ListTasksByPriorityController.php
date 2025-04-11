<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;


use App\Application\UseCases\Query\ListTasksByPriorityUseCase;
use App\Presentation\Http\Mappers\ListTasksRequestToListTasksInputMapper;
use App\Presentation\Http\Requests\Tasks\ListTasksRequest;
use App\Presentation\Http\Responses\Tasks\ListTasksByPriorityResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/tasks/priority",
    operationId: "listTasksByPriority",
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
            content: new OA\JsonContent(ref: "#/components/schemas/ListTasksByPriorityResponse")
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
class ListTasksByPriorityController
{
    public function __construct(
        private ListTasksByPriorityUseCase $listTasksByPriorityUseCase,
        private ListTasksRequestToListTasksInputMapper $listTasksRequestToListTasksInputMapper
    ) {
    }

    public function __invoke(ListTasksRequest $request): ListTasksByPriorityResponse
    {
        $input = $this->listTasksRequestToListTasksInputMapper->map($request);
        $tasks = $this->listTasksByPriorityUseCase->handle($input);

        return new ListTasksByPriorityResponse($tasks->tasks);
    }
}
