<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'fullname'=>'required|string',
            'email'=>'required|email|string|unique:users,email',
            'phoneNumber'=>'required',
            'password'=>'required|confirmed',
        ]);
        $user = User::create([
            'name' => $data['fullname'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'password' => bcrypt($data['password']),
        ]);
        // $user = Auth::users();
        $token = $user->createToken('Auth')->plainTextToken;

        return response ([
            'users'=>$user,
            'token'=>$token
        ],200);
    }
    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email|string',
            'password'=>'required',
        ]);
        if(!Auth::attempt($data)){
            return response([
                'error'=>'The provided credentials  dont match our records'
            ],422);
        }else{
            $user = Auth::user();
            $token = $request->user()->createToken('Auth
            ')->plainTextToken;
           return response([
                    'user'=>$user,
                    'token' => $token
                ],200);
        }

    }
    public function logout(Request $request){
        auth()->logout();
        return response([
                    'user'=>'',
                    'token' => null
                ],200);       
    }
}
