<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Redirect home to products list
Route::get('/', fn() => redirect()->route('products.index'));

// Products resource (CRUD)
Route::resource('products', ProductController::class);

// Cart routes (session-based cart)
Route::get('/cart',              [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}',   [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{product}',  [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart',           [CartController::class, 'clear'])->name('cart.clear');




