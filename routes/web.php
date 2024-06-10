<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('tasks/index', [App\Http\Controllers\HomeController::class, 'index'])->name('tasks.index');

Route::middleware(['auth'])->as('tasks.')->group(function(){
    // Route::get('index', [TaskController::class, 'index'])->name('index');
    Route::get('create', [TaskController::class, 'create'])->name('create');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::get('show/{id}', [TaskController::class, 'show'])->name('show');
    Route::get('{id}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('update', [TaskController::class, 'update'])->name('update');
    Route::delete('destroy', [TaskController::class, 'destroy'])->name('destroy');

    Route::resource('tasks', TaskController::class);
});


// Route::middleware(['auth'])->group(function () {
//     Route::get('/tasks', [TodoController::class, 'index'])->name('tasks.index');
//     Route::post('/tasks', [TodoController::class, 'store'])->name('tasks.store');
//     Route::put('/tasks/{task}', [TodoController::class, 'update'])->name('tasks.update');
//     Route::delete('/tasks/{task}', [TodoController::class, 'destroy'])->name('tasks.destroy');
// });


