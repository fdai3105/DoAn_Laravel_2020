<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return view('/');
        } else {
            return redirect()->back();
        }
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return response()->json(['status' => 'success','message' => 'Login successful']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Login failed']);
        }
    }

    public function getSignup()
    {
        return view('/');
    }

    public function postSignup(Request $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        if ($user) {
            Auth::login($user);
            return response()->json(['status' => 'success', 'message' => 'Signup successful']);
        } else {
            return response()->json(['status' => 'error', 'message' => $user]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->back();
    }
}
