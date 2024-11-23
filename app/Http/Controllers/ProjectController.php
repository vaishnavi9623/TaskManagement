<?php

namespace App\Http\Controllers;
use App\Models\Project;
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
                    return '<a href="#" class="btn btn-info btn-sm">View</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Projects/project');
        // return view('projects.project', compact('project'));

    }
}
