<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserStreetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'Login']);
Route::post('/register', [RegisterController::class, 'Register']);

Route::group(['middleware' => 'jwt'], function () {
    Route::post("/regenerate-token", [LoginController::class, 'RegenerateToken']);

    Route::get("/profile-info/{userId}", [UsersController::class, 'GetUserInfo']);
    Route::put("/profile-info/{userId}", [UsersController::class, 'SetUserInfo']);
    Route::put("/profile-picture/{userId}", [UsersController::class, 'SetProfilePicture']);

    Route::post("/add-address", [UserStreetController::class, 'AddAddress']);
    Route::get("/get-address/{userId}", [UserStreetController::class, 'GetAddress']);
});

