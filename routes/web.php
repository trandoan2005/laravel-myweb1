<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Client Controllers
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Auth Client
Route::get('/login', [ClientAuthController::class, 'login'])->name('customer.login');
Route::post('/login', [ClientAuthController::class, 'postLogin'])->name('customer.login.post');
Route::get('/register', [ClientAuthController::class, 'register'])->name('customer.register');
Route::post('/register', [ClientAuthController::class, 'postRegister'])->name('customer.register.post');
Route::post('/logout', [ClientAuthController::class, 'logout'])->name('customer.logout');

// Products
Route::get('/products', [ClientProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ClientProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [ClientProductController::class, 'category'])->name('products.category');
Route::get('/brand/{slug}', [ClientProductController::class, 'brand'])->name('products.brand');
Route::get('/search', [ClientProductController::class, 'search'])->name('products.search');

// Cart & Checkout
Route::prefix('cart')->controller(CartController::class)->name('cart.')->group(function () {
    Route::get('/show', 'show')->name('show');
    Route::post('/add/{id}', 'addToCart')->name('add');
    Route::delete('/remove/{id}', 'removeCart')->name('remove');
    Route::post('/checkout', 'checkout')->name('checkout');
});
Route::get('/checkout', [CartController::class, 'checkoutIndex'])->name('checkout.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/test', function () {
    return "Test";
});

Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])
        ->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])
        ->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postforgotPassword'])
        ->name('forgotpass.post');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD - Resource route
        Route::middleware('roles:1')->group(function () {
            // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
            Route::get('trash/categories', [CategoryController::class, 'trash'])
                ->name('categories.trash');
            // Khôi phục
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
                ->name('categories.restore');
            // Xóa vĩnh viễn
            Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete']) 
                ->name('categories.forceDelete');

            Route::resource('categories', CategoryController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('users', UserController::class);
            Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'destroy']);
            Route::resource('products', ProductController::class);
            Route::resource('posts', PostController::class);
            Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
            Route::patch('orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])
                ->name('orders.updateStatus');
        });
        Route::resource('products', ProductController::class)
            ->only(['index'])->middleware('roles:1,2');
    });
});

Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);