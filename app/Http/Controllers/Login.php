<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Login extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('zyler')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


  public function register(Request $request)  {
    $request->validate([
        'name'=>'required|min:5',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:8|confirmed'
    ]);

    try {
    User::create([
        'name'=>$request['name'],
        'email'=>$request['email'],
        'password'=>Hash::make($request['password'])
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('zyler')->plainTextToken;

        return response()->json(['token' => $token]);
    }


    } catch (e) {
  return response()->json(['message'=>e], 200, $headers);
    }


    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out from all devices'], 200);
    }
    
}
