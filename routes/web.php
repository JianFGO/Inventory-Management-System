<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category routes
Route::resource('/category', App\Http\Controllers\CategoryController::class, ['names' => 'category']);

// Product routes
Route::resource('/product', App\Http\Controllers\ProductController::class, ['names' => 'product']);
