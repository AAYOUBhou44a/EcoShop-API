<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:6|confirmed'

        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'password'=>hash::make($request->password)
        ]);
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token],201);

    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user  || !hash::check($request->password , $user->password) ){
            return response()->json(['message'=>'not the correct info'],401);
        }
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user]);

    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message','you are logout']);

    }
    public function me(Request $request){
        return response()->json($request->user());

    }
}
