<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\IsUserLoggedIn;
use App\Http\Controllers\TaskController;


Route::get('/', function () { return view('login', ['name' => 'Samantha']); })->name('login.form');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(IsUserLoggedIn::class);


Route::post('/login', [LoginController::class, 'ValidateUser'])->name('login');


Route::get('/task/{status?}', [TaskController::class, 'index'])->name('task')->middleware(IsUserLoggedIn::class);



