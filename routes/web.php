<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/products/show', [ProductController::class, 'show'])->name('products.show');