<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "name" => ["string"],
            "email" => ["string", "email", "unique:users"],
            "password" => ["string", "confirmed"],
            "phone" => ["string"],
            "birth_place" => ["string"],
            "birth_date" => ["date"],
            "birth_gender" => ["string"],
            "profession" => ["string"],
            "address" => ["string"],
            "image" => ["image", "max:2048"],
            "role" => ["string"],
        ]);

        $user = User::find($id);
        
        if ($request->image !== null){
            $path = $request->image->store("images/users", "public");
            $fields["image"] = $path;
        }

        $user->update($fields);

        return [
            "user" => $user,
        ];


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
