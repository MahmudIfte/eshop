<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Fronrend\WishlistController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontendController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('view-category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('view-category/{cate_slug}/{prod_slug}', [FrontendController::class, 'productview']);

Auth::routes();
Route::get('load-cart-data', [CartController::class, 'cartcount']);
Route::get('load-wishlist-count', [WishlistController::class, 'wishlistcount']);
Route::post('/add-to-cart', [CartController::class, 'addProduct']);
Route::post('/delete-cart-item', [CartController::class, 'deleteproduct']);
Route::post('/update-cart', [CartController::class, 'updatecart']);
Route::post('add-to-wishlist', [WishlistController::class, 'add']);
Route::post('delete-wishlist-item', [WishlistController::class, 'deleteitem']);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'viewcart']);
    // Route::post('/add-to-cart', [CartController::class, 'addProduct']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/place-order', [CheckoutController::class, 'placeorder']);
    Route::get('/my-orders', [UserController::class, 'index']);
    Route::get('view-order/{id}', [UserController::class, 'view']);


    Route::get('wishlist', [WishlistController::class, 'index']);
    // Route::post('/update-cart', [CartController::class, 'updatecart']);
    // Route::post('/add-to-cart', [CartController::class, 'addProduct']);

    Route::post('add-rating', [RatingController::class, 'add']);
    Route::get('add-review/{product_slug}/userreview',[ReviewController::class,'add']);
    Route::post('add-review',[ReviewController::class, 'create']);
    Route::get('edit-review/{product_slug}/userreview',[ReviewController::class,'edit']);
    Route::put('update-review',[ReviewController::class,'update']);

    Route::post('proceed to pay', [CheckoutController::class, 'razorpaycheck']);
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        // return "This is admin";
        return view('admin.index');
    });

    Route::get('/dashboard', 'Admin\FrontendController@index');

    Route::get('/categories', 'Admin\CategoryController@index');
    Route::get('/add-category', 'Admin\CategoryController@add');
    // Route::post('/insert-category', 'Admin\CategoryController@insert');
    Route::post('/insert-category', [CategoryController::class, 'insert']);
    Route::get('/edit-product/{id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{id}', [CategoryController::class, 'update']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/add-products', [ProductController::class, 'add']);
    Route::post('/insert-product', [ProductController::class, 'insert']);
    Route::get('/edit-pro/{id}', [ProductController::class, 'edit']);
    Route::put('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);

    Route::get('users', [FrontendController::class, 'users']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('admin/view-order/{id}', [OrderController::class, 'view']);
    Route::put('update-order/{id}', [OrderController::class, 'updateorder']);
    Route::get('order-history', [OrderController::class, 'orderhistory']);
    Route::get('users', [DashboardController::class, 'users']);
    Route::get('view-user/{id}', [DashboardController::class, 'viewuser']);

    Route::get('search', [ProductController::class, 'search']);
});
