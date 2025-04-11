<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;

use App\Application\UseCases\Command\DeleteTaskUseCase;
use App\Presentation\Http\Mappers\DeleteTaskRequestToDeleteTaskInputMapper;
use App\Presentation\Http\Requests\Tasks\DeleteTaskRequest;
use App\Presentation\Http\Responses\Tasks\DeleteTaskResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/tasks/{id}",
    operationId: "deleteTask",
    summary: "Удалить задачу",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: "#/components/schemas/DeleteTaskRequest")
    ),
    tags: ["tasks"],
    responses: [
        new OA\Response(
            response: 204,
            description: "Успешно удалена задача",
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateTaskResponse")
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
readonly class DeleteTaskController
{
    public function __construct(
        private DeleteTaskUseCase $deleteTaskUseCase,
        private DeleteTaskRequestToDeleteTaskInputMapper $deleteTaskRequestToDeleteTaskInputMapper
    ) {
    }

    public function __invoke(DeleteTaskRequest $request): JsonResponse
    {
        $request->validated();

        $this->deleteTaskUseCase->handle(
            $this->deleteTaskRequestToDeleteTaskInputMapper->map($request)
        );

        return response()->json(new DeleteTaskResponse(), 204);
    }
}
