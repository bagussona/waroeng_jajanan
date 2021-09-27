<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request){
        // $logged_in = true;
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $logged_in = Auth::user()->username;

        return response()->json(compact('logged_in', 'token'), 200);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'email' => $request->get('email'),
            'nohape' => 026244112,
            'gender' => 'Undefined',
            'password' => Hash::make($request->get('password'))
        ]);

        $user->assignRole('customer');

        return response()->json(['msg' => 'berhasil mendaftar, silahkan cek email anda utk verikasi akun.'], 201);
    }


}
