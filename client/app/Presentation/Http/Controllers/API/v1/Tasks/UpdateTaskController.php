<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;

use App\Application\UseCases\Command\UpdateTaskUseCase;
use App\Presentation\Http\Mappers\UpdateTaskRequestToUpdateTaskInputMapper;
use App\Presentation\Http\Requests\Tasks\UpdateTaskRequest;
use App\Presentation\Http\Responses\Tasks\UpdateTaskResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Patch(
    path: "/tasks/{id}",
    operationId: "updateTask",
    summary: "Редактировать задачу",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: "#/components/schemas/UpdateTaskRequest")
    ),
    tags: ["tasks"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Идентификатор задачи для обновления",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer", example: 1)
        )
    ], responses: [
        new OA\Response(
            response: 201,
            description: "Успешно обновлена задача",
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateTaskResponse")
        ),
        new OA\Response(
            response: 400,
            description: "Клиентская ошибка",
            content: new OA\JsonContent(ref: "#/components/schemas/ClientErrorResponse")
        ),
        new OA\Response(
            response: 422,
            description: "Ошибка валидации",
            content: new OA\JsonContent(ref: "#/components/schemas/ValidationErrorResponse")
        ),
        new OA\Response(
            response: 500,
            description: "Внутренняя ошибка сервера",
            content: new OA\JsonContent(ref: "#/components/schemas/ServerErrorResponse")
        ),
    ],
)]
readonly class UpdateTaskController
{
    public function __construct(
        private UpdateTaskUseCase $updateTaskUseCase,
        private UpdateTaskRequestToUpdateTaskInputMapper $updateTaskRequestToUpdateTaskInputMapper
    ) {
    }

    public function __invoke(UpdateTaskRequest $request): JsonResponse
    {
        $request->validated();

        $input = $this->updateTaskRequestToUpdateTaskInputMapper->map($request);
        $this->updateTaskUseCase->handle($input);

        return response()->json(new UpdateTaskResponse(), 201);
    }
}
