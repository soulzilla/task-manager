<?php

use App\Presentation\Http\Controllers\API\v1\Tasks;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/priority', Tasks\ListTasksByPriorityController::class)->name('priority');
        Route::post('/', Tasks\CreateTaskController::class)->name('create');
        Route::patch('/{id}', Tasks\UpdateTaskController::class)->name('update');
        Route::put('/{id}', Tasks\UpdateTaskController::class)->name('update');
        Route::delete('/{id}', Tasks\DeleteTaskController::class)->name('delete');
        Route::get('/', Tasks\ListTasksController::class)->name('index');
        Route::get('/{id}', Tasks\ShowTaskController::class)->name('show');
    });
});
