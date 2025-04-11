<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;

use App\Application\UseCases\Query\ShowTaskUseCase;
use App\Presentation\Http\Mappers\ShowTaskRequestToShowTaskInputMapper;
use App\Presentation\Http\Requests\Tasks\ShowTaskRequest;
use App\Presentation\Http\Responses\Tasks\ShowTaskResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/tasks/{id}",
    operationId: "showTask",
    summary: "Получить задачу",
    tags: ["tasks"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Идентификатор задачи для получения",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer", example: 1)
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успешно получена задача",
            content: new OA\JsonContent(ref: "#/components/schemas/ShowTaskResponse")
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
readonly class ShowTaskController
{
    public function __construct(
        private ShowTaskUseCase $showTaskUseCase,
        private ShowTaskRequestToShowTaskInputMapper $showTaskRequestToShowTaskInputMapper
    ) {

    }

    public function __invoke(ShowTaskRequest $request): ShowTaskResponse
    {
        $task = $this->showTaskUseCase->handle(
            $this->showTaskRequestToShowTaskInputMapper->map($request)
        );

        return new ShowTaskResponse($task);
    }
}
