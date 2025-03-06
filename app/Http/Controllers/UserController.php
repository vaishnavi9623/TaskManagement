<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(Request $request, $status = null)
    {
   
    //<a href="#"  data-id="' . $row->id . '" class="viewlog"><i class="fa fa-history text-success"></i></a>
    if ($request->ajax()) {
        $users = User::all();
         return DataTables::of($users)
         ->addColumn('photo', function ($row) {
            if ($row->photo) {
                return '<img src="' . asset('storage/uploads/employees/' . $row->photo) . '" 
                    alt="User Photo" style="width: 50px; height: 50px; border-radius: 50%;">';
            }
            return '<span class="text-muted">No Photo</span>';
        })
        
            ->addColumn('action', function ($row) {
                return '
                
                    <a href="#" class="viewUser " data-id="' . $row->id . '"><i class="fa-regular fa-eye"></i></a>
                    <a href="' . route('getdataforedit', ['id' => $row->id]) . '" class="editUser" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                    <a href="' . route('deleteuser', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="deleteuser"><i class="fa-solid fa-trash text-danger"></i></a>
                    <a href="#"  data-id="' . $row->id . '" class="updatepassword"><i class="fa fa-unlock-alt text-dark"></i></a>';
            })
            ->rawColumns(['action','photo']) 
            ->make(true);
    }

    return view('Users/user');
    }

    public function saveuser(Request $request)
    {
        //dd($request);

            $validate = $request->validate([
                "name"=>'required|string',
                "email"=>'required|email',
                "phone_number"=>'required',
                "designation"=>'required',
                "department"=>'required',
                "position"=>'required',
                "status"=>'required',
                "joining_date"=>'required | date',
                "photo"=>'required',
                "address"=>'required'
            ]);

           
             if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName(); // Create unique file name
                $path = $file->storeAs('uploads/employees', $filename, 'public'); // Store file in public/uploads/users
                $validate['photo'] = $filename; // Save path to validated data
            }

            //dd($filename);
           $user = User::create([
                'name'=>$validate['name'],
                'email'=>$validate['email'],
                'phone_number'=>$validate['phone_number'],
                'designation'=>$validate['designation'],
                'department'=>$validate['department'],
                'position'=>$validate['position'],
                'status'=>$validate['status'],
                'joining_date'=>$validate['joining_date'],
                'photo'=>$filename,
                'address'=>$validate['address'],
                'password' => Hash::make('password123')
            ]);
            // dd($user);
            return redirect()->route('user')->with('success', 'User added successfully!');
    }

    public function getdataforedit($id)
    {
        // Fetch user details by ID for editing
        $user = User::findOrFail($id);
        return view('Users.updateuser', compact('user'));
    }

    public function updateUser($id, Request $request)
    {

        $validate = $request->validate([
            "name"=>'required|string',
            "email"=>'required|email',
            "phone_number"=>'required',
            "designation"=>'required',
            "department"=>'required',
            "position"=>'required',
            "status"=>'required',
            "joining_date"=>'required | date',
            "photo"=>'required',
            "address"=>'required'
        ]);
        // dd($request->file('photo'));

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName(); // Create unique file name
            $path = $file->storeAs('uploads/employees', $filename, 'public'); // Store file in public/uploads/users
            $validate['photo'] = $filename; // Save path to validated data
        }
        // dd($path);

        User::where('id',$id)
            ->update($validate);

        return redirect()->route('user')->with('success', 'User updated successfully!');


    }
    public function updatepass($id, Request $request)
    {

        $req =  $request->all();
        
        $data = ['password'=>Hash::make($req['password'])];
            User::where('id',$id)->update($data);

        return redirect()->route('user')->with('success', 'User updated successfully!');

    }

    public function deleteuser($id)
    {
        $user = User::findorFail($id);
        $user->delete();
        return response()->json(['message'=>'User deleted successfully']);
    }

    public function getUserDetails($id)
    {
        $user = User::findorFail($id);
        return response()->json($user); 
    }
}
