<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "unique:users"],
            "password" => ["required", "string", "confirmed"],
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return [
            "user" => $user,
            "token" => $token->plaiTextToken,
        ];
    }

    public function login(Request $request)
    {

        $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "string"]
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return [
                "message" => "The provided credentials doesn't match our records !",
            ];
        }

        $token = $user->createToken($user->name);

        return [
            "user" => $user,
            "token" => $token->plaiTextToken,
        ];
    }


    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return [
            "message" => "You are logged out",
        ];
    }
}
