<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\SubTask;
use App\Models\User;
use App\Models\TaskComment;
use App\Models\TaskNote;
use Carbon\Carbon;

use Yajra\DataTables\Facades\DataTables;


class TaskController extends Controller
{
  
   public function index(Request $request, $status = null)
    {

    if ($request->ajax()) {
      if($status){$tasks = Task::where('status',$status)->get();}
      else{$tasks = Task::with('subTasks')->get();
        }
        //dd($tasks);
        if ($tasks ==null) {
            return response()->json([
                'status' => 'success',
                'message' => 'No tasks found'
            ]);
        }
        $UserId = Auth::id();
        return DataTables::of($tasks)
            ->addColumn('action', function ($row) use ($UserId) { // Pass $UserId explicitly using "use"
                return '
                    <a href="#" class="viewTask" data-id="' . $row->id . '"><i class="fa-regular fa-eye"></i></a>
                    <a href="' . route('gettaskdataforedit', ['id' => $row->id]) . '" class="editTask" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                    <a href="' . route('deletetask', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="deletetask"><i class="fa-solid fa-trash text-danger"></i></a>
                    <a href="#" data-task-id="' . $row->id . '" data-user-id="' . $UserId . '" class="addnote"><i class="fa fa-sticky-note text-primary"></i></a>
                    <a href="#" data-id="' . $row->id . '" class="addcomment"><i class="fa fa-commenting text-success"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('Task/task');
    }

    public function addnewtask(Request $request)
    {
        //dd($request);
        $UserId = Auth::id();
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
                'subtask' => 'required',

            ]);
            $task = Task::create([
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
            //dd($task->id);
            // Check if $task is created
            if ($task) {
                //dd($validate['subtask']);
                $subtask = implode(", ", (array) $validate['subtask']);
                    SubTask::create([
                    'title' => $subtask, 
                    'task_id' => $task->id, 
                    'created_by'=>$UserId,
                    'updated_by'=>$UserId,
                ]);
               // dd($subtask);
            } else {
                return response()->json(['error' => 'Task creation failed'], 500);
            }
            return redirect()->route('task')->with('success', 'Task added successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());  // If there's an error, it will show here
        }
        

    }

    public function gettaskdataforedit($id)
    {
        $task = Task::with('subTasks')->findOrFail($id);
        $users = User::all(); 
        $task->starttime = Carbon::parse($task->starttime)->format('Y-m-d');
        $task->endtime = Carbon::parse($task->endtime)->format('Y-m-d');
        $task->deadline = Carbon::parse($task->deadline)->format('Y-m-d');

        return view('Task.updatetask', compact('task','users'));
    }
    public function deletetask($id)
    {
        $task = Task::findorFail($id);
        $task->delete();
        return response()->json(['message'=>'Task deleted successfully']);
    }

    public function gettaskdetails($id)
    {   
        $task = Task::findorFail($id);
        return response()->json($task); 
    }

    public function updatestatus(Request $request){
        $request->validate([
            'taskids' => 'required', // Ensure task exists
            'status' => 'required|string', // Adjust statuses as needed
        ]);
    
        // Update the task status
        $task = Task::where('id', $request->id)->update(['status' => $request->status]);
    
        // Check if update was successful
        if ($task) {
            return redirect()->route('task')->with('success', 'Task updated successfully!');
        } else {
            return redirect()->route('task')->with('error', 'Failed to update task!');
        }

    }
    public function updatetask($id, Request $request)
    {
        $UserId = Auth::id();
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
                'subtask' => 'required',

            ]);
            $taskdata = [
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
            ];
            $task = Task::Where('id',$id)->update($taskdata);
            //dd($task);
            if ($task) {
                $subtask = implode(", ", (array) $validate['subtask']);
                    $subtask = [
                    'title' => $subtask, 
                    'created_by'=>$UserId,
                    'updated_by'=>$UserId,
                ];
                SubTask::Where('task_id',$id)->update($subtask);

            } else {
                return response()->json(['error' => 'Task updation failed'], 500);
            }
            return redirect()->route('task')->with('success', 'Task updated successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());  
        }
        

    }

    public function gettasknotes($id)
    {
        $UserId = Auth::id();
        $tasknotes = TaskNote::Where('task_id',$id)
                    // ->where('user_id', $UserId) 
                    ->join('users', 'task_notes.user_id', '=', 'users.id')
                    ->select('task_notes.*', 'users.name as user_name')
                    ->orderBy('task_notes.created_at', 'desc')
                    ->get();
        return response()->json($tasknotes); 
    }

    public function gettaskcomments($id){
        $UserId = Auth::id();
        $taskcomment = TaskComment::Where('task_id',$id)
                    // ->where('user_id', $UserId) 
                    ->join('users', 'task_comments.user_id', '=', 'users.id')
                    ->select('task_comments.*', 'users.name as user_name')
                    ->orderBy('task_comments.created_at', 'desc')
                    ->get();
        return response()->json($taskcomment);
    }
    public function savenote(Request $request)
    {
       $UserId =  Auth::id();
       $validate = $request->validate([
        'note'=>'required|string',
        'task_id'=>'required',
       ]);

       $noteddata = TaskNote::create([
        'note'=>$validate['note'],
        'task_id'=>$validate['task_id'],
        'user_id'=>$UserId
       ]);
       if($noteddata){
       return redirect()->route('task')->with('success', 'Noted added successfully!');
       }
    }

    public function savecomment(Request $request)
    {    
        $UserId = Auth::id();
    
        $validate = $request->validate([
            'comments' => 'required|string',
            'taskid' => 'required', 
        ]);

        $commentdata = TaskComment::create([
            'comments' => $validate['comments'],
            'task_id' => $validate['taskid'],
            'user_id' => $UserId
        ]);
        if ($commentdata) {
            return redirect()->route('task')->with('success', 'Comments added successfully!');
        }
    }
    
}
