<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Authentication
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::middleware('auth:sanctum')->group(function (){
    
    // Get Authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Logout
    Route::post("/logout", [AuthController::class, "logout"]);
});


// Model's CRUD

