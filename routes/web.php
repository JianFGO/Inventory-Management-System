<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ContentSecurityPolicy;

// Default Login Page
Route::get('/', function () {
    return view('auth/login');
});

// Authentication Routes
Auth::routes(['verify' => true]);

// Home and Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Category Routes
Route::resource('/category', App\Http\Controllers\CategoryController::class, ['names' => 'category']);
Route::get('/category/product/{id}', [App\Http\Controllers\OrderController::class, 'getProduct'])->name('product.get');

// Product Routes
Route::resource('/product', App\Http\Controllers\ProductController::class, ['names' => 'product']);

// Order Routes (Restricted to Manager and Admin)
Route::middleware(['custom_permission:manage orders'])->group(function () {
    Route::resource('/order', App\Http\Controllers\OrderController::class, ['names' => 'order']);
});

// User Management Routes (Restricted to Admin)
Route::middleware(['custom_permission:manage users'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class, ['names' => 'user']);
});

// Access Denied Page
Route::get('/access-denied', function () {
    return view('errors.access-denied');
});

// Profile Routes
Route::middleware(['auth', ContentSecurityPolicy::class])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Order Invoice
use App\Http\Controllers\OrderController;

Route::get('/order/{id}/invoice', [OrderController::class, 'generateInvoice'])->name('order.invoice');

// Apply CSP Middleware Globally to All Routes
Route::middleware([ContentSecurityPolicy::class])->group(function () {
    // Place routes here if you want the middleware applied only to specific areas.
});

// Logout Route
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
