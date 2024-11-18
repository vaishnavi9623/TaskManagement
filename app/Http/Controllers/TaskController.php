<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Yajra\DataTables\Facades\DataTables;


class TaskController extends Controller
{
   // public function index($status=NULL)
   // {
      //   if($status)
      //   {$tasks = Task::where('status',$status)->get();}
   //    //   else{$tasks = Task::all();}
   //    //   return view('task', compact('tasks'));
      
   // }

   public function index(Request $request, $status = null)
{
   
    if ($request->ajax()) {
      //dd($status);
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

    return view('task');
}
}
