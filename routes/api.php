<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/*',function(){
return view('app');
});

Route::get('/user',function(){
return response()->json(["user"=>auth()->user()]);
})->middleware('api');
Route::group(['prefix' => 'auth'], function () {
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])
->middleware('auth:sanctum');
Route::post('refresh', [AuthController::class, 'refresh'])
->middleware('auth:sanctum');
});