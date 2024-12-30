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

    public function saveuser(Request $request)
    {
            $validate = $request->validate([
                "name"=>'required|string',
                "email"=>'required|email',
                "phone"=>'required',
                "designation"=>'required',
                "department"=>'required',
                "position"=>'required',
                "status"=>'required',
                "joining_date"=>'required | date',
                "photo"=>'required',
                "address"=>'required'
            ]);

            User::create([
                'name'=>$validate['name'],
                'email'=>$validate['email'],
                'phone_number'=>$validate['phone'],
                'designation'=>$validate['designation'],
                'department'=>$validate['department'],
                'position'=>$validate['position'],
                'status'=>$validate['status'],
                'joining_date'=>$validate['joining_date'],
                'photo'=>$validate['photo'],
                'address'=>$validate['address']
            ]);

            return redirect()->route('user')->with('success', 'User added successfully!');
    }
}
