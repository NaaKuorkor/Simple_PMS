<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//----------View routes----------
Route::view('/', 'auth.login');
Route::view('/login', 'auth.login')->name("login");
Route::view('/register', 'auth.register')->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/verify-email/{id}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verify.email');
Route::post('/user-register', [AuthController::class, "register"])->name('user.register');
