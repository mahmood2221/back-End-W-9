<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/features', [HomeController::class, 'features']);
Route::get('/team', [HomeController::class, 'team']);


Route::resource('products', ProductController::class);

