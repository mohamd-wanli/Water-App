<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistributorController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\ProductController;

Route::post('/register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('profile',[DistributorController::class,'register']);

Route::prefix('distributor')->middleware(['auth:distributor_api','distributor'])->group(function (){

    Route::post('update/{id}',[DistributorController::class,'update']);
    Route::Delete('delete/{id}',[DistributorController::class,'delete']);
});

Route::prefix('admin')->middleware(['auth:api','admin'])->group(function (){
    Route::post('approve/{id}',[AdminController::class,'approve']);
    Route::post('reject/{id}',[AdminController::class,'reject']);
    Route::get('pending',[AdminController::class,'getPending']);
});

Route::prefix('product')->middleware(['auth:api','role:distributor'])->group(function (){
Route::post('create',[ProductController::class,'create']);
Route::post('update/{id}',[ProductController::class,'update']);
Route::delete('delete/{id}',[ProductController::class,'delete']);
Route::get('get',[ProductController::class,'getProduct']);
});

Route::get('filter',[ProductController::class,'index'])->middleware('auth:api');
