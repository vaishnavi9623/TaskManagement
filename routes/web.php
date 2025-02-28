<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\IsUserLoggedIn;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CalendarController;
use App\Models\User;


//For Login...
Route::get('/', function () { return view('Auth.login', ['name' => 'Samantha']); })->name('login.form');
Route::post('login', [LoginController::class, 'ValidateUser'])->name('login');

//For Dashboard View
Route::get('/dashboard', function () {return view('Dashboard.dashboard');})->name('dashboard')->middleware(IsUserLoggedIn::class);



//For Task Management -------------------------------------------------------------------------------------------------
Route::post('task/save',[TaskController::class,'addnewtask'])->name('task.save');
Route::get('/task/{status?}', [TaskController::class, 'index'])->name('task')->middleware(IsUserLoggedIn::class);
// Route::get('/addtask', function () {return view('Task.addtask');})->name('addtask')->middleware(IsUserLoggedIn::class);

Route::get('/addtask', function () {
    $users = User::all(); // Fetch all users from the database
    return view('Task.addtask', compact('users'));
})->name('addtask')->middleware(IsUserLoggedIn::class);

Route::get('/task/gettaskdataforedit/{id}', [TaskController::class, 'gettaskdataforedit'])->name('gettaskdataforedit');
Route::delete('/task/deletetask/{id}', [TaskController::class, 'deletetask'])->name('deletetask');
Route::get('/tasks/{id}', [TaskController::class, 'gettaskdetails'])->name('gettaskdetails');
Route::put('/task/update/{id}', [TaskController::class, 'updatetask'])->name('task.update');

// for user management ---------------------------------------------------------------------------------------------------------------
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/adduser', function () {return view('Users.adduser');})->name('adduser')->middleware(IsUserLoggedIn::class);
Route::post('user/saveUser',[UserController::class,'saveuser'])->name('user.save');
Route::get('/user/getdataforedit/{id}', [UserController::class, 'getdataforedit'])->name('getdataforedit');
Route::put('/user/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
Route::delete('/user/deleteuser/{id}', [UserController::class, 'deleteuser'])->name('deleteuser');
Route::get('/user/{id}', [UserController::class, 'getUserDetails'])->name('getuserdetails');


Route::get('/projects', [ProjectController::class, 'index'])->name('project');
Route::get('/addprojects', function () {return view('Projects.addprojects');})->name('addprojects')->middleware(IsUserLoggedIn::class);

// Route::get('/timetrack', function () { return view('Task.timetrack'); })->name('timetrack');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');

Route::get('/setting', function () {return view('Setting.setting');})->name('setting')->middleware(IsUserLoggedIn::class);

Route::get('/notification', function () {return view('Notification.notification');})->name('notification')->middleware(IsUserLoggedIn::class);

Route::get('/time-track', function () {return view('TimeTrack.timetrack');})->name('time-track')->middleware(IsUserLoggedIn::class);

Route::get('/reports', function () {return view('Reports.reports');})->name('reports')->middleware(IsUserLoggedIn::class);

Route::get('/teams', function () {return view('Teams.team');})->name('teams')->middleware(IsUserLoggedIn::class);


Route::get('/setting-notification', function () {
    return view('setting.notifications'); 
})->name('setting.notifications')->middleware(IsUserLoggedIn::class);