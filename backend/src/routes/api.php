<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
Route::get('/me',[AuthController::class,'me']);
Route::post('/logout',[AuthController::class,'logout']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('cart', CartController::class);
});

Route::middleware(['auth:sanctum'])->group(function(){
 Route::get('/products',[ProductController::class , 'index']);
 Route::get('/products/{id}',[ProductController::class,'show']);
 Route::middleware(['admin'])->group(function(){
        Route::post('/products',[ProductController::class,'store']);
        Route::put('/products/{id}',[ProductController::class,'update']);
        Route::delete('/products/{id}',[ProductController::class,'destroy']);
 });
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    Route::middleware(['admin'])->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    });
});
