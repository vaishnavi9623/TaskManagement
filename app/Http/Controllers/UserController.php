<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function index(Request $request, $status = null)
    {
   
    if ($request->ajax()) {
        $users = User::all();
         return DataTables::of($users)
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

    return view('Users/user');
    }
}
