<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TaskPriorityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed', ['--class' => 'TaskSeeder']);
    }

    public function test_priority_endpoint_returns_sorted_tasks()
    {
        $response = $this->getJson('/api/v1/tasks/priority');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'priority_score']]]);
    }
}
