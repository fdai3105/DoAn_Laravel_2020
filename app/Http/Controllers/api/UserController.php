<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserInfo(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_email_or_password'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'), 200);
    }

    public function register(Request $request)
    {
        // check form validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], [
            'name.required' => 'Tên đăng nhập không được để trống.',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã có người sử dụng.',

            'password.required' => 'Mật không được để trống.',
            'password.min' => 'Mật khẩu ít nhất 8 kí tự.'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $user = $this->user->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        $credentials = $request->only('name', 'password');
        $token = JWTAuth::attempt($credentials);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $token,
        ], 200);
    }
}
