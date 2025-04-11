<?php

namespace App\Presentation\Http\Controllers\API\v1\Tasks;

use App\Application\UseCases\Command\CreateTaskUseCase;
use App\Presentation\Http\Mappers\CreateTaskRequestToCreateTaskInputMapper;
use App\Presentation\Http\Requests\Tasks\CreateTaskRequest;
use App\Presentation\Http\Responses\Tasks\CreateTaskResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/tasks",
    operationId: "createTask",
    summary: "Создать новую задачу",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: "#/components/schemas/CreateTaskRequest")
    ),
    tags: ["tasks"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Успешно создана задача",
            content: new OA\JsonContent(ref: "#/components/schemas/CreateTaskResponse")
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
    ]
)]
readonly class CreateTaskController
{
    public function __construct(
        private CreateTaskUseCase $createTaskUseCase,
        private CreateTaskRequestToCreateTaskInputMapper $createTaskRequestToCreateTaskInputMapper
    ) {
    }

    public function __invoke(CreateTaskRequest $request): JsonResponse
    {
        $request->validated();

        $this->createTaskUseCase->handle(
            $this->createTaskRequestToCreateTaskInputMapper->map($request)
        );

        return response()->json(new CreateTaskResponse(), 201);
    }
}
