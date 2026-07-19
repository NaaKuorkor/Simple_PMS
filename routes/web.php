<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

//----------View routes----------
Route::view('/', 'auth.login');
Route::view('/login', 'auth.login')->name("login");
Route::view('/register', 'auth.register')->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/verify-email/{id}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verify.email');
Route::post('/user-register', [AuthController::class, "register"])->name('user.register');

//Project Routes
//An easier way -> Route::resource('projects', ProjectController::class);
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/show/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/destroy/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

//Task Routes
//An easier way -> Route::resource('tasks', TaskController::class);
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/show/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/destroy/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
