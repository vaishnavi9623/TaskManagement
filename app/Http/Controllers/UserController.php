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
                    <a href="#" class="viewUser" data-id="' . $row->id . '"><i class="fa-regular fa-eye"></i></a>
                    <a href="#" ><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" ><i class="fa-solid fa-trash"></i></a>
                ';
            })
            ->make(true);
    }

    return view('Users/user');
    }
}
