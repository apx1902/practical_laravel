<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\otpController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'Register'])->middleware('api');
Route::post('/login',[AuthController::class,'Login']);
Route::post('/send-otp', [otpController::class, 'sendOtp']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'Logout']);
    Route::post('/search',[CategoryController::class,'search']);

    Route::group(['prefix' => 'category'],function () {
        Route::get('/list',[CategoryController::class,'index']);
        Route::post('/create',[CategoryController::class,'store']);
        Route::post('/update/{id}',[CategoryController::class,'update']);
        Route::post('/delete/{id}',[CategoryController::class,'destroy']);
        Route::get('/list/{page}',[CategoryController::class,'paginate']);
    });

    Route::group(['prefix'=>'subcategory'],function (){
        Route::get('/list',[SubCategoryController::class,'index']);
        Route::post('/create',[SubcategoryController::class,'store']);
        Route::post('update/{id}',[SubcategoryController::class,'update']);
        Route::post('/delete/{id}',[SubcategoryController::class,'destroy']);
        Route::get('/list/{page}',[SubcategoryController::class,'paginate']);
    });

});

