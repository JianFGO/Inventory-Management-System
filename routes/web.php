<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category routes
Route::resource('/category', App\Http\Controllers\CategoryController::class, ['names' => 'category']);

// Product routes
Route::resource('/product', App\Http\Controllers\ProductController::class, ['names' => 'product']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Order routes (only manager and admin can access)
Route::middleware(['custom_permission:manage orders'])->group(function () {
    Route::resource('/order', App\Http\Controllers\OrderController::class, ['names' => 'order']);
});

// Category routes
Route::get('/category/product/{id}', [App\Http\Controllers\OrderController::class, 'getProduct'])->name('product.get');

// User routes (only admin can access)
Route::middleware(['custom_permission:manage users'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class, ['names' => 'user']);
});

Route::get('/access-denied', function () {
    return view('errors.access-denied');
});
