<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
Route::group(['middleware' => 'guest:api'], function () {
    Route::post("/register", [UserController::class, "register"]);
    Route::post("/login", [UserController::class, "login"]);
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::post("/home", [UserController::class, "index"]);
    Route::get('/auth/user', [UserController::class, 'getAuthUser']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::apiResource('posts', PostController::class);
    Route::post('/posts/{id}',[PostController::class,'update']);
});


Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});
