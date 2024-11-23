<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Yajra\DataTables\Facades\DataTables;


class CalendarController extends Controller
{
    public function index()
    {
    return view('Calender/calender');
    }

    public function getEvents()
{
    $tasks = Task::all();
    $events = $tasks->map(function($task) {
        return [
            'title' => $task->name,
            'start' => $task->starttime, 
            'end' => $task->endtime,
            'color' => $task->priority === 'high' ? '#e74c3c' : '#e67e22', // Red for high priority, orange for others

        ];
    });

    return response()->json($events);
}


}
