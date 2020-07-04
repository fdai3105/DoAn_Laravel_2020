<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * when go to admin/login 
     */
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('admin');
        } else {
            return view('admin.login');
        }
    }

    /**
     * when click login submit
     **/
    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect('admin');
        } else {
            return redirect()->back()->withErrors('Sai tên đăng nhập hoặc mật khẩu');
        }
    }

    /**
     * lougout admin
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
