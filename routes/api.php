<?php

use Illuminate\Auth\Middleware\Authenticate; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route; 

Route::get('/user', function (Request $request) { 
    return $request->user(); 
})->middleware(Authenticate::using('sanctum')); 

//posts 
Route::apiResource('/product', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/order', App\Http\Controllers\Api\OrderController::class);