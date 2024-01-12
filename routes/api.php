<?php

use App\Http\Controllers\ClientAddressController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\SaleController;
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

    Route::post("/product", [ProductController::class, 'Create']);
    Route::get("/product", [ProductController::class, 'List']);
    Route::get("/product/{productId}", [ProductController::class, 'Get']);
    Route::put("/product/{productId}", [ProductController::class, 'Update']);

    Route::get("/product-status", [ProductStatusController::class, 'List']);

    Route::get("/client", [ClientController::class, 'List']);
    Route::post("/client", [ClientController::class, 'Create']);
    Route::put("/client/{clientId}", [ClientController::class, 'Update']);
    Route::get("/client/{clientId}", [ClientController::class, 'Get']);

    Route::post("/client-address", [ClientAddressController::class, 'Set']);

    Route::get("/client-status", [ClientStatusController::class, 'List']);

    Route::post("/sale", [SaleController::class, 'Create']);
});

