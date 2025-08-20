<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

// Для авторизованих користувачів
Route::middleware('auth')->group(function () {

    Route::post('/chat-private', [ChatController::class, 'chatPrivate']);

    Route::middleware(['role:manager,admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{id}', [UserController::class, 'updateName'])->name('users.updateName');
        Route::put('/users/{id}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
        Route::get('/users/{user}/tasks', [UserController::class, 'userTasks'])
            ->name('users.tasks');

        Route::get('/files', [FileController::class, 'index'])->name('files.index');
        Route::post('/files', [FileController::class, 'upload'])->name('files.upload');
        Route::get('/files/download/{id}', [FileController::class, 'download'])->name('files.download');
        Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.delete');
        Route::patch('/files/{file}/due-date', [FileController::class, 'updateDueDate'])->name('files.updateDueDate');
        Route::patch('/files/{file}/done', [FileController::class, 'updateDone'])->name('files.updateDone');
        Route::get('/files/{file}/task', [FileController::class, 'fileTask'])->name('files.task');

        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('/tasks/{user}/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks/{user}', [TaskController::class, 'store'])->name('tasks.store');
        Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::patch('/tasks/{task}/due-date', [TaskController::class, 'updateDueDate'])->name('tasks.updateDueDate');
        Route::patch('/tasks/{task}/done', [TaskController::class, 'updateDone'])->name('tasks.updateDone');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});


require __DIR__ . '/auth.php';
