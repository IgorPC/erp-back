<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'Login']);
Route::post('/register', [RegisterController::class, 'Register']);

Route::get('/login', function (Request $request) {
    return response()->json([
        'success' => "yes"
    ]);
});

