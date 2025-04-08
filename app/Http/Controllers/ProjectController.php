<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ProjectController extends Controller
{
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $projects = Project::all(); 
            return DataTables::of($projects)
                ->addIndexColumn() 
                ->addColumn('action', function($row) {
                    return '<a href="#" class="viewproject" data-id="' . $row->id . '"><i class="fa-regular fa-eye"></i></a>
                            <a href="' . route('getprjdataforedit', ['id' => $row->id]) . '" class="editPrj" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                            <a href="' . route('deleteproject', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="deleteproject" data-id="' . $row->id . '"><i class="fa-solid fa-trash text-danger"></a>';
                })
                ->addColumn('project_manager', function ($row) {
                    return User::find($row->project_manager)?->name ?? 'N/A';
                })
                ->addColumn('assigned_team', function ($row) {
                    return Team::find($row->assigned_team)?->name ?? 'N/A';
                })
                ->rawColumns(['action','project_manager','assigned_team'])
                ->make(true);
        }
        return view('Projects/project');

    }

    public function saveProject(request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'start_date'=>'required',
            'deadline'=>'required',
            'status'=>'required',
            'priority'=>'required',
            'client'=>'required',
            'budget'=>'required',
            'estimated_completion'=>'required',
            'manager'=>'required',
            'assigned_team'=>'required',
            'logo'=>'required'
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName(); // Create unique file name
            $path = $file->storeAs('uploads/projects', $filename, 'public'); // Store file in public/uploads/projects
            $validate['logo'] = $filename; // Save path to validated data
        }
        $project = Project::create([
            'name'=>$validate['name'],
            'description'=>$validate['description'],
            'start_date'=>$validate['start_date'],
            'end_date'=>$validate['deadline'],
            'status'=>$validate['status'],
            'priority'=>$validate['priority'],
            'client_name'=>$validate['client'],
            'budget'=>$validate['budget'],
            'project_manager'=>$validate['manager'],
            'assigned_team'=>$validate['assigned_team'],
            'attachments'=>$filename,
        ]);
        if($project){
            return redirect()->route('project')->with('success', 'Project added successfully!');
        }
        else
        {
            return response()->json(['error' => 'Project creation failed'], 500);
        }

    }

    public function getprjdataforedit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all(); 
        $teams = Team::all(); 

        return view('Projects.updateproject', compact('project','teams','users'));

    }
    public function deleteproject($id)
    {
        $project = Project::findorFail($id);
        $project->delete();
        return response()->json(['message'=>'Project deleted successfully']);

    }

    public function updateProject($id, Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'start_date'=>'required',
            'deadline'=>'required',
            'status'=>'required',
            'priority'=>'required',
            'client'=>'required',
            'budget'=>'required',
            'estimated_completion'=>'required',
            'manager'=>'required',
            'assigned_team'=>'required',
            'logo'=>'required'
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName(); // Create unique file name
            $path = $file->storeAs('uploads/projects', $filename, 'public'); // Store file in public/uploads/projects
            $validate['logo'] = $filename; // Save path to validated data
        }
        $projectdata = [
            'name'=>$validate['name'],
            'description'=>$validate['description'],
            'start_date'=>$validate['start_date'],
            'end_date'=>$validate['deadline'],
            'status'=>$validate['status'],
            'priority'=>$validate['priority'],
            'client_name'=>$validate['client'],
            'budget'=>$validate['budget'],
            'project_manager'=>$validate['manager'],
            'assigned_team'=>$validate['assigned_team'],
            'attachments'=>$filename,
        ];
        
        $project = Project::where('id',$id)
            ->update($projectdata);
        if($project){
            return redirect()->route('project')->with('success', 'Project updated successfully!');
        }
        else
        {
            return response()->json(['error' => 'Project updation failed'], 500);
        }

    }

    public function getprojectdetails($id)
    {
        $prj = Project::with('projectManager', 'team')->findOrFail($id); // Assuming the relationship is defined
        return response()->json($prj);
    }
}
