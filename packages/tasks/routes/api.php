<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Package\Tasks\Http\Controllers\TeamController;
use Package\Tasks\Http\Controllers\ProirityController;
use Package\Tasks\Http\Controllers\TaskController;
use Package\Tasks\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use Package\Tasks\Http\Controllers\ManageController;
use Package\Tasks\Http\Controllers\ChangeMangerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware(['is_admin','auth:sanctum','locale'])->prefix('admin')->group(function (){
Route::resource('/proirities', ProirityController::class);
Route::resource('/tasks', TaskController::class);
Route::patch('/tasks/{task}', [TaskController::class,'addMember'])->name('tasks.addMember');
Route::resource('/members', MemberController::class);
Route::resource('/teams', TeamController::class);
Route::patch('/tasks/showStatue/{task}',[ManageController::class,'changeStatue'])->name('changeStatue');
Route::patch('/teams/{team}/{member}',[ChangeMangerController::class,'manger'])->name('changeManger');
});
Route::middleware(['auth:sanctum','is_user','locale'])->group(function (){
     Route::get('/home/tasks',[ManageController::class,'tasks'])->name('tasks');
     Route::get('/home/teams',[ManageController::class,'teams']);
     Route::get('/home/teams/{id}',[ManageController::class,'members']);
     Route::patch('/home/tasks/showStatue/{task}',[ManageController::class,'changeStatue'])->name('changeStatue');
});
