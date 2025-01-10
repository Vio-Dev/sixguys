<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BinController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Website\profileControllers;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\checkoutController;
use App\Http\Controllers\Website\postsContoller;
use App\Http\Controllers\Website\WishlistController;

use Illuminate\Support\Facades\Route;



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes

Route::prefix('admin')->middleware(['auth', 'checkRole'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('list', [CategoriesController::class, 'index'])->name('list');
        Route::get('create', [CategoriesController::class, 'create'])->name('create');
        Route::post('/', [CategoriesController::class, 'store'])->name('store');
        // Route::get('{id}', [CategoriesController::class, 'show'])->name('show');
        Route::get('{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
        Route::post('list', [CategoriesController::class, 'search'])->name('search');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('list', [ProductsController::class, 'index'])->name('list');
        Route::get('create', [ProductsController::class, 'create'])->name('create');
        Route::post('/', [ProductsController::class, 'store'])->name('store');
        // Route::get('{id}', [ProductsController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ProductsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ProductsController::class, 'destroy'])->name('destroy');
        Route::post('list', [ProductsController::class, 'search'])->name('search');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('list', [UsersController::class, 'index'])->name('list');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::post('/', [UsersController::class, 'store'])->name('store');
        // Route::get('{id}', [UsersController::class, 'show'])->name('show');
        Route::get('{id}/edit', [UsersController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('update');
        Route::patch('update/{id}', [UsersController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('delete/{id}', [UsersController::class, 'destroy'])->name('destroy');
        Route::post('list', [UsersController::class, 'search'])->name('search');
    });

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('list', [BlogsController::class, 'index'])->name('list');
        Route::get('create', [BlogsController::class, 'create'])->name('create');
        Route::post('/', [BlogsController::class, 'store'])->name('store');
        // Route::get('{id}', [BlogsController::class, 'show'])->name('show');
        Route::get('{id}/edit', [BlogsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BlogsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [BlogsController::class, 'destroy'])->name('destroy');
        Route::post('list', [BlogsController::class, 'search'])->name('search');
    });
    Route::prefix('bin')->name('bin.')->group(function () {
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('list', [BinController::class, 'category'])->name('list');
            Route::delete('delete/{id}', [BinController::class, 'destroyCategory'])->name('destroy');
            Route::delete('update/{id}', [BinController::class, 'updateCategory'])->name('update');
        });
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('list', [BinController::class, 'blog'])->name('list');
            Route::delete('delete/{id}', [BinController::class, 'destroyBlogs'])->name('destroy');
            Route::delete('update/{id}', [BinController::class, 'updateBlogs'])->name('update');
        });
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('list', [BinController::class, 'product'])->name('list');
            Route::delete('delete/{id}', [BinController::class, 'destroyProducts'])->name('destroy');
            Route::delete('update/{id}', [BinController::class, 'updateProducts'])->name('update');
        });
        Route::prefix('variants')->name('variants.')->group(function () {
            Route::get('list', [BinController::class, 'variant'])->name('list');
            Route::delete('delete/{id}', [BinController::class, 'destroyVariants'])->name('destroy');
            Route::delete('update/{id}', [BinController::class, 'updatevariants'])->name('update');
            Route::post('list', [BinController::class, 'search'])->name('search');
            Route::delete('deleteValue/{id}', [VariantController::class, 'destroyValue'])->name('destroyValue');
            Route::delete('updateValue/{id}', [BinController::class, 'updateValue'])->name('updateValue');
        });
    });
    Route::prefix('don-hang')->name('don-hang.')->group(function () {
        Route::get('list', [OrderController::class, 'index'])->name('list');
        Route::get('create', [OrderController::class, 'create'])->name('create');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('show/{id}', [OrderController::class, 'show'])->name('show');
        Route::delete('delete/{id}', [OrderController::class, 'destroyOrder'])->name('destroy');
        Route::put('update/{id}', [OrderController::class, 'update'])->name('update');
        Route::patch('updateStatus/{orderId}', [OrderController::class, 'updateStatus'])->name('updateStatus');
    });
    Route::prefix('variants')->name('variants.')->group(function () {
        Route::get('list', [VariantController::class, 'index'])->name('list');
        Route::get('create', [VariantController::class, 'create'])->name('create');
        Route::post('/', [VariantController::class, 'store'])->name('store');
        Route::get('{id}/edit', [VariantController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [VariantController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [VariantController::class, 'destroy'])->name('destroy');
        Route::delete('deleteValue/{id}', [VariantController::class, 'destroyValue'])->name('destroyValue');
        Route::post('list', [VariantController::class, 'search'])->name('search');
    });
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('list-post', [commentController::class, 'post'])->name('post');
        route::put('update/post/{id}', [commentController::class, 'updatePost'])->name('edit');
        route::delete('delete/post/{id}', [commentController::class, 'deletePost'])->name('destroy');
        Route::get('list-product', [commentController::class, 'product'])->name('product');
        route::put('update/{id}', [commentController::class, 'updateProduct'])->name('updateProduct');
        route::delete('delete/{id}', [commentController::class, 'deleteProduct'])->name('deleteProduct');
    });
});

// user routes
Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/search', [WebsiteController::class, 'search'])->name('search');
Route::get('/san-pham', [WebsiteController::class, 'product'])->name('products');
Route::get('/san-pham/{id}', [WebsiteController::class, 'productDetail'])->name('productDetail');
Route::post('/san-pham/{id}', [WebsiteController::class, 'productComment'])->name('productComments');
Route::delete('/san-pham/{id}', [WebsiteController::class, 'productDelete'])->name('productDelete');

Route::prefix('gio-hang')->middleware(['auth'])->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});

Route::prefix('yeu-thich')->middleware(['auth'])->name('wishlists.')->group(function () {
    // Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add'])->name('add');
    Route::put('/update/{id}', [WishlistController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [WishlistController::class, 'remove'])->name('remove');
});

Route::prefix('thanh-toan')->middleware(['auth'])->name('checkout.')->group(function () {
    Route::get('/', [checkoutController::class, 'index'])->name('index');
    Route::post('/', [checkoutController::class, 'store'])->name('store');
});

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('confirm/{order}/{user}', [OrderController::class, 'confirm'])->name('confirm');
    Route::post('cancel/{orderId}', [OrderController::class, 'cancel'])->name('cancel');
});

Route::get('/success', function () {
    return view('website.order.confirm-success');
})->name('success');
Route::get('/fail', function () {
    return view('website.order.confirm-fail');
})->name('failed');


Route::prefix('ho-so')->middleware(['auth'])->name('ho-so.')->group(function () {
    Route::get('/', [ProfileControllers::class, 'index'])->name('ho-so');
    Route::get('/don-hang', [ProfileControllers::class, 'order'])->name('don-hang');
    Route::post('/don-hang/{id}', [ProfileControllers::class, 'orderDetail'])->name('don-hang-chi-tiet');
    Route::get('/yeu-thich', [ProfileControllers::class, 'wishlist'])->name('yeu-thich');

    Route::post('/dang-xuat', [ProfileControllers::class, 'logout'])->name('dang-xuat');
});
Route::get('/bai-viet', [WebsiteController::class, 'blog'])->name('blogs');
Route::get('/bai-viet/{id}', [postsContoller::class, 'show'])->name('postDetail');
Route::post('bai-viet/{id}', [postsContoller::class, 'postComments'])->name('postsComments');
Route::delete('bai-viet/{id}', [postsContoller::class, 'postsCommentsDelete'])->name('postsCommentsDelete');

Route::get('/mail', function () {
    return view('mail.invoice');
});

require __DIR__ . '/auth.php';
