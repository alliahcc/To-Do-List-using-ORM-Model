<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// PAGES' ROUTES
Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::get('/progress', [TaskController::class, 'progress'])->name('progress');
Route::get('/completed', [TaskController::class, 'completed'])->name('completed');

// ADD AND COMPLETE TASK
Route::get('/createTask', [TaskController::class, 'createTask'])->name('createTask');
Route::post('/createTask', [TaskController::class, 'handleCreateTask'])->name('createTask.submit');
Route::patch('/tasks/{id}/completeTask', [TaskController::class, 'completeTask'])->name('completeTask');

// EDIT TASK
Route::get('/edit/{id}', [TaskController::class, 'editRecord'])->name('editRecord');
Route::patch('/update/{id}', [TaskController::class, 'updateRecord'])->name('updateRecord');

// DELETION AND RESTORE
Route::get('/trashbin', [TaskController::class, 'trashbin'])->name('trashbin');
Route::delete('/task/{id}', [TaskController::class, 'softDeleteRecord'])->name('softDeleteRecord');
Route::delete('/task/{id}/force', [TaskController::class, 'forceDeleteRecord'])->name('forceDeleteRecord');
Route::patch('/task/{id}/restore', [TaskController::class, 'restoreRecord'])->name('restoreRecord');
