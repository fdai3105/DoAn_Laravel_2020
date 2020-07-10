<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserInfo()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json($user);
    }

    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users',
        ], [
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã có người sử dụng.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 404);
        }

        $user = JWTAuth::toUser($request->token);
        $user->update($request->all());
        if ($user) {
            return response()->json(['message' => 'User updated successfully'], 200);
        } else {
            return response()->json(['message' => 'User updated failed'], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            JWTAuth::factory()->setTTL(99999999999999999);
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_email_or_password'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(['token' => $token, 'expires_in' => JWTFactory::getTTL() * 60], 200);
    }

    public function register(Request $request)
    {
        // check form validation
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'fullname.required' => 'Họ tên không được để trống.',

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
            'fullname' => $request->get('fullname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        if ($user) {
            $credentials = $request->only('fullname', 'password');
            $token = JWTAuth::attempt($credentials);
            return response()->json([
                'message' => 'User created successfully',
                'fullname' => $user->fullname,
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['message' => 'Cannot created user'], 500);
        }
    }
}
