<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $validator = Validator::make(
            $login,
            [
                'email' => 'required|email:rfc,dns',
                'password' => 'required|min:8'
            ],
            [
                'email.required' => 'Email không được để trống.',
                'email.email' => 'Email không đúng định dạng.',

                'password.required' => 'Mật không được để trống.',
                'password.min' => 'Mật khẩu ít nhất 8 kí tự.'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'isValidator' => 'true', 'message' => $validator->errors()->all()]);
        }
        $remember = ($request->get('rememberMe') == null ? false : true);
        if (Auth::attempt($login, $remember)) {
            return response()->json(['status' => 'success', 'message' => 'Login successful']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Login failed']);
        }
    }

    public function postSignup(Request $request)
    {
        $signup = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->email,
        ];

        $validator = Validator::make(
            $signup,
            [
                'fullname' => 'required',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required|min:8',
            ],
            [
                'fullname.required' => 'Tên không được để trống.',

                'email.required' => 'Email không được để trống.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã có người dùng.',

                'password.required' => 'Mật khẩu không được để trống.',
                'password.min' => 'Mật khẩu ít nhất 8 kí tự.'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'isValidator' => 'true', 'message' => $validator->errors()->all()]);
        }

        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        if ($user) {
            Auth::login($user, false);
            return response()->json(['status' => 'success', 'message' => 'Tạo user thành công.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Không thể tạo user:' + $user]);
        }
    }

    public function logout()
    {
        Cart::destroy();
        Auth::logout();
        return redirect()->back();
    }
}
