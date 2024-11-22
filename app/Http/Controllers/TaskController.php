<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Yajra\DataTables\Facades\DataTables;


class TaskController extends Controller
{
  
   public function index(Request $request, $status = null)
    {
   
    if ($request->ajax()) {
      if($status){$tasks = Task::where('status',$status)->get();}
      else{$tasks = Task::all();}
         return DataTables::of($tasks)
            ->addColumn('action', function ($row) {
                return '
                    <a href="#" class="btn btn-info btn-sm">View</a>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <form action="#" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this task?\')">Delete</button>
                    </form>
                ';
            })
            ->make(true);
    }

    return view('Task/task');
    }

    public function addnewtask(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'starttime' => 'required|date',
                'endtime' => 'required|date',
                'deadline' => 'required|date',
                'status' => 'required|string|in:pending,completed,inprogress,overdue,upcoming',
                'category' => 'required|string|in:development,design,testing',
                'priority' => 'required|string|in:low,medium,high',
                'recurring_task' => 'required|string',
                'assign_to' => 'required',

            ]);
            Task::create([
                'name'=>$validate['title'],
                'description'=>$validate['description'],
                'starttime'=>$validate['starttime'],
                'endtime'=>$validate['endtime'],
                'deadline'=>$validate['deadline'],
                'status'=>$validate['status'],
                'category'=>$validate['category'],
                'priority'=>$validate['priority'],
                'assign_to'=>$validate['assign_to'],

                'recurring_task'=>$validate['recurring_task']
            ]);
            return redirect()->route('task')->with('success', 'Task added successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());  // If there's an error, it will show here
        }
        

    }
}
