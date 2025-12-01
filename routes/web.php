<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC CATALOG
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('catalog');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Home
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Categories CRUD
        Route::resource('categories', CategoryController::class);

        // Products CRUD
        Route::resource('products', AdminProductController::class);

        // Users list
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        // User delete
        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });

// CART — only for logged users
Route::middleware('auth')->group(function () {
    Route::get('/compare', [ProductController::class, 'compare'])->name('compare');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [\App\Http\Controllers\CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'remove'])
        ->name('cart.remove');
});

/*
|--------------------------------------------------------------------------
| USER PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
