<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function ValidateUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'captcha' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->password === md5($request->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
    
                Auth::login($user);
                return redirect()->intended('dashboard');
            } else {
                if (Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->intended('dashboard');
                }
            }
        }

        return back()->with('error', 'Invalid credentials or captcha.');
        
    }
        
    }

