<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
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
class TasksController extends Controller
{
    #[OA\Get(
        path: '/tasks',
        description: 'Возвращает список задач с возможностью фильтрации по статусу',
        summary: 'Получить список задач',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'status',
                description: 'Фильтр по статусу задачи (TODO, IN_PROGRESS, COMPLETED)',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['TODO', 'IN_PROGRESS', 'COMPLETED'])
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список задач',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/Task')
                            )
                        ]
                    )
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Ошибка сервера',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Failed to fetch tasks')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $tasks = Task::query();

            if ($request->has('status')) {
                $tasks->where('status', $request->status);
            }

            return TaskResource::collection($tasks->get());
        } catch (\Throwable $e) {
            Log::error('Error fetching tasks: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch tasks'], 500);
        }
    }

    #[OA\Post(
        path: '/tasks',
        description: 'Создает новую задачу',
        summary: 'Создать задачу',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/TaskRequest')
        ),
        tags: ['Tasks'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Задача успешно создана',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', ref: '#/components/schemas/Task')
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Ошибка сервера',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Failed to create task')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function store(TaskRequest $request): JsonResponse|TaskResource
    {
        try {
            $task = Task::create($request->validated());
            return new TaskResource($task);
        } catch (\Throwable $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create task'], 500);
        }
    }

    #[OA\Get(
        path: '/tasks/{task}',
        description: 'Возвращает задачу по ID',
        summary: 'Получить задачу',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                description: 'ID задачи',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Данные задачи',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', ref: '#/components/schemas/Task')
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Задача не найдена',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Task not found')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function show(Task $task): JsonResponse|TaskResource
    {
        try {
            return new TaskResource($task);
        } catch (\Throwable $e) {
            Log::error('Error fetching task: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch task'], 500);
        }
    }

    #[OA\Put(
        path: '/tasks/{task}',
        description: 'Обновляет данные задачи',
        summary: 'Обновить задачу',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/TaskRequest')
        ),
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                description: 'ID задачи',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Задача успешно обновлена',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', ref: '#/components/schemas/Task')
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Ошибка сервера',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Failed to update task')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function update(TaskRequest $request, Task $task): JsonResponse|TaskResource
    {
        try {
            $task->update($request->validated());
            return new TaskResource($task);
        } catch (\Throwable $e) {
            Log::error('Error updating task: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update task'], 500);
        }
    }

    #[OA\Delete(
        path: '/tasks/{task}',
        description: 'Удаляет задачу по ID',
        summary: 'Удалить задачу',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                description: 'ID задачи',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'Задача успешно удалена'
            ),
            new OA\Response(
                response: 500,
                description: 'Ошибка сервера',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Failed to delete task')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function destroy(Task $task): JsonResponse|Response
    {
        try {
            $task->delete();
            return response()->noContent();
        } catch (\Throwable $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete task'], 500);
        }
    }

    #[OA\Get(
        path: '/tasks/priority',
        description: 'Возвращает задачи, отсортированные по приоритету',
        summary: 'Приоритизация задач',
        tags: ['Tasks'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список задач с приоритетами',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Task')
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Ошибка сервера',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string', example: 'Failed to fetch prioritized tasks')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function priority(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $tasks = Task::all()->map(function ($task) {
                $daysUntilDeadline = now()->diffInDays($task->deadline);
                $task->priority_score = $task->importance * (1 / max($daysUntilDeadline, 1));
                $task->is_overdue = $daysUntilDeadline < 0;
                return $task;
            })->sortByDesc('priority_score');

            return TaskResource::collection($tasks);
        } catch (\Throwable $e) {
            Log::error('Error fetching prioritized tasks: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch prioritized tasks'], 500);
        }
    }
}
