<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|string|unique:users',
            'password'=>'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        $token = $user->createToken('MyToken')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'message'=>'User created successfully',
            'status'=>true,
            'token'=>$token
        ],201);
    }

    public function Login(Request $request){
        $request->validate([
            'email'=>'required|email|string',
            'password'=>'required|string'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password ,$user->password)){
            return response()->json([
                'message'=>'Invalid credentials',
                'status'=>false,
            ],401);
        }

        $token = $user->createToken('MyToken')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'message'=>'User logged in successfully',
            'status'=>true,
            'token'=>$token
        ],200);
    }

    public function Logout(Request $request){
        if(!$request->user){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=>'User logged out successfully',
            'status'=>true,
        ],200);
    }
        else {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => false,
            ], 401);
        }
    }
}
