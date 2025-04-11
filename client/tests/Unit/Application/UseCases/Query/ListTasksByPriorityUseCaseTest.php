<?php

namespace Tests\Unit\Application\UseCases\Query;

use App\Application\DTO\Inputs\ListTasksInput;
use App\Application\DTO\Outputs\ListTasksByPriorityOutput;
use App\Application\Services\TasksPrioritizationService;
use App\Application\UseCases\Query\ListTasksByPriorityUseCase;
use App\Domain\Collections\TasksCollection;
use App\Domain\Criteria\TasksCriteria;
use App\Domain\Entities\TaskEntity;
use App\Domain\Enums\TaskStatus;
use App\Domain\Repositories\TasksRepositoryInterface;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class ListTasksByPriorityUseCaseTest extends TestCase
{
    public function testHandleReturnsCorrectOutput()
    {
        $faker = FakerFactory::create();
        $mockRepository = $this->createMock(TasksRepositoryInterface::class);
        $tasksPrioritizationService = app()->make(TasksPrioritizationService::class);

        $tasks = new TasksCollection();
        for ($i = 0; $i < 10; $i++) {
            $task = new TaskEntity(
                id: $faker->randomNumber(),
                title: $faker->sentence(),
                description: $faker->paragraph(),
                status: $faker->randomElement([
                    TaskStatus::TODO,
                    TaskStatus::IN_PROGRESS,
                    TaskStatus::COMPLETED
                ]),
                importance: $faker->numberBetween(1, 5),
                deadline: $faker->date(),
                createdAt: $faker->dateTime()->format('Y-m-d H:i:s'),
                updatedAt: $faker->dateTime()->format('Y-m-d H:i:s')
            );
            $tasks->append($task);
        }

        $mockRepository->method('getAllTasks')
            ->willReturn($tasks);

        $useCase = new ListTasksByPriorityUseCase(
            tasksRepository: $mockRepository,
            tasksPrioritizationService: $tasksPrioritizationService
        );

        $input = new ListTasksInput(status: null);

        $output = $useCase->handle($input);

        $this->assertInstanceOf(ListTasksByPriorityOutput::class, $output);
        $this->assertIsArray($output->tasks);

        foreach ($output->tasks as $task) {
            $this->assertArrayHasKey('id', $task);
            $this->assertArrayHasKey('title', $task);
            $this->assertArrayHasKey('description', $task);
            $this->assertArrayHasKey('status', $task);
            $this->assertArrayHasKey('importance', $task);
            $this->assertArrayHasKey('deadline', $task);
            $this->assertArrayHasKey('is_overdue', $task);
            $this->assertArrayHasKey('priority_score', $task);
            $this->assertArrayHasKey('created_at', $task);
            $this->assertArrayHasKey('updated_at', $task);
        }

        $priorityScores = array_column($output->tasks, 'priority_score');

        $sortedScores = $priorityScores;
        rsort($sortedScores);

        $this->assertEquals($sortedScores, $priorityScores);
    }
}
