<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $fields = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "string", "email", "unique:users"],
            "password" => ["required", "string", "confirmed"],
            "phone" => ["string"],
            "birth_place" => ["string"],
            "birth_date" => ["date"],
            "birth_gender" => ["string"],
            "profession" => ["string"],
            "address" => ["string"],
            "role" => ["string"],
        ]);


        $user = User::create($fields);
        $user->generateCardId();

        $token = $user->createToken($request->name);
        
        $user["token"] = $token->plainTextToken;

        return [
            "user" => $user,
        ];
    }

    public function login(Request $request)
    {

        $request->validate([
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"],
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return [
                "message" => "The provided credentials doesn't match our records !",
            ];
        }

        $token = $user->createToken($user->name);
        $user["token"] = $token->plainTextToken;

        return [
            "user" => $user,
        ];
    }


    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return [
            "message" => "You are logged out !",
        ];
    }
}
