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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [\App\Http\Controllers\PageController::class, 'index'])->name('index');

Route::get('/shop/{id?}', [\App\Http\Controllers\PageController::class, 'shop'])->name('shop');
Route::get('/search', [\App\Http\Controllers\PageController::class, 'search'])->name('search');

Route::get('/single-product/{id}', [\App\Http\Controllers\PageController::class, 'singleProduct'])->name('single_product');

Route::get('/cart', [\App\Http\Controllers\PageController::class, 'cart'])->name('cart');
Route::get('/order-history', [\App\Http\Controllers\PageController::class, 'orderHistory'])->name('order_history')->middleware('auth');
Route::post('/re-order', [\App\Http\Controllers\PageController::class, 'reOrder'])->name('re_order');

Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addItem'])->name('cart.add');
Route::get('/cart/delete/{id}', [App\Http\Controllers\CartController::class, 'deleteItem'])->name('cart.delete');
Route::get('/cart/increase-by-one/{id}', [App\Http\Controllers\CartController::class, 'increaseQuantityByOne'])->name('cart.increase_by_one');
Route::get('/cart/decrease-by-one/{id}', [App\Http\Controllers\CartController::class, 'decreaseQuantityByOne'])->name('cart.decrease_by_one');

Route::get('/checkout', [\App\Http\Controllers\PageController::class, 'checkout'])->name('checkout');
Route::post('/order', [\App\Http\Controllers\PageController::class, 'order'])->name('order');

Route::get('stripe', [\App\Http\Controllers\PageController::class, 'stripe'])->name('stripe_form');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function (){
       return view('backend.index');
    });
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('comments', \App\Http\Controllers\CommentController::class);
    Route::resource('imports', \App\Http\Controllers\ImportController::class);
    Route::resource('import_details', \App\Http\Controllers\ImportDetailController::class);
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::resource('order_details', \App\Http\Controllers\OrderDetailController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('payment_methods', \App\Http\Controllers\PaymentMethodController::class);
    Route::resource('tags', \App\Http\Controllers\TagController::class);
});

Route::get('login', [\App\Http\Controllers\PageController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\PageController::class, 'postLogin'])->name('login.post');
Route::get('logout', [\App\Http\Controllers\PageController::class, 'logout'])->name('logout');
Route::get('register', [\App\Http\Controllers\PageController::class, 'register'])->name('register');
Route::post('register', [\App\Http\Controllers\PageController::class, 'postRegister'])->name('register.post');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
