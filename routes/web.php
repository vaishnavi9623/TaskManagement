<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\IsUserLoggedIn;
use App\Http\Controllers\TaskController;

//For Login...
Route::get('/', function () { return view('Auth.login', ['name' => 'Samantha']); })->name('login.form');
Route::post('login', [LoginController::class, 'ValidateUser'])->name('login');

//For Dashboard View
Route::get('/dashboard', function () {return view('Dashboard.dashboard');})->middleware(IsUserLoggedIn::class);



//For Task Management
Route::post('task/save',[TaskController::class,'addnewtask'])->name('task.save');
Route::get('/task/{status?}', [TaskController::class, 'index'])->name('task')->middleware(IsUserLoggedIn::class);
Route::get('/addtask', function () {return view('Task.addtask');})->name('addtask')->middleware(IsUserLoggedIn::class);

