<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/test',[UserController::class, 'test']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/profile',[UserController::class, 'index']);
    Route::put('/profile/profileUpdate',[UserController::class, 'profileUpdate']);
    Route::put('/profile/change-password',[UserController::class, 'updatePassword']);
    Route::post('logout', [AuthController::class, 'logout']);
});
