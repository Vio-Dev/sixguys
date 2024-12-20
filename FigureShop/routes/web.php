<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('list', [CategoriesController::class, 'index'])->name('list');
        Route::get('create', [CategoriesController::class, 'create'])->name('create');
        Route::post('/', [CategoriesController::class, 'store'])->name('store');
        // Route::get('{id}', [CategoriesController::class, 'show'])->name('show');
        Route::get('{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('list', [ProductsController::class, 'index'])->name('list');
        Route::get('create', [ProductsController::class, 'create'])->name('create');
        Route::post('/', [ProductsController::class, 'store'])->name('store');
        // Route::get('{id}', [ProductsController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ProductsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ProductsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('list', [UsersController::class, 'index'])->name('list');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::post('/', [UsersController::class, 'store'])->name('store');
        // Route::get('{id}', [UsersController::class, 'show'])->name('show');
        Route::get('{id}/edit', [UsersController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [UsersController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('list', [BlogsController::class, 'index'])->name('list');
        Route::get('create', [BlogsController::class, 'create'])->name('create');
        Route::post('/', [BlogsController::class, 'store'])->name('store');
        // Route::get('{id}', [BlogsController::class, 'show'])->name('show');
        Route::get('{id}/edit', [BlogsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BlogsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [BlogsController::class, 'destroy'])->name('destroy');
    });
});



// user routes




require __DIR__ . '/auth.php';
