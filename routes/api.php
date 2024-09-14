<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;
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

Route::apiResource("plans", PlanController::class);
Route::apiResource("subscriptions", SubscriptionController::class);
Route::put("/subscriptions/{subscription}/upgrade", [SubscriptionController::class, "upgrade"]);
Route::put("/subscriptions/{subscription}/renew", [SubscriptionController::class, "renew"]);
Route::apiResource("payments", PaymentController::class);
Route::apiResource("claims", ClaimController::class);
