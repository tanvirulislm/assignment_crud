<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Create
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products');

// Edit
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Show
Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');

// Delete
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Search
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');