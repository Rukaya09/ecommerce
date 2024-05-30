<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customerlogincontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Gateways\RazorpayController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::middleware(['auth', 'user.type.redirect'])->group(function () {
    // Routes that require authentication and user type redirection
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
});

// Routes that do not require authentication or user type redirection
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin.home');

Route::get('user.home', [HomeController::class, 'index'])->name('user.home');




Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.details');
// Route for showing products where category_id = 1 on the welcome page
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('welcome');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'showAll'])->name('products');


Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');


Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


Route::post('/products', [ProductController::class, 'store'])->name('product.store');
// Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/', [ProductController::class, 'showWebsite'])->name('home');

Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('/product/{id}', [ProductController::class, 'update'])->name('product.update');


// Route for displaying the form
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
// 

// Route for handling form submission
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');


Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');


Route::post('/cart/add', [CartController::class,'addItem'])->name('cart.add');

Route::post('razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');

Route::post('/store_contact', [ContactsController::class, 'store'])->name('store_contact');
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');

use App\Http\Controllers\ShippingController;

Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');

use App\Http\Controllers\OrderController;

// Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/orders', [OrderController::class, 'showOrders'])->name('admin.orders');
Route::get('/dashboard', function () {
    return view('admin.dashboard'); // Assuming your dashboard view is located in 'resources/views/admin/dashboard.blade.php'
})->name('admin.dashboard');


Route::get('/admin/shippings', [ShippingController::class, 'index'])->name('admin.shippings');
// web.php
Route::get('/search', [ProductController::class, 'search'])->name('search');



Route::get('/products/category/{category_id}', [ProductController::class, 'showAllProducts'])->name('all.products');






// Route to update order status

Route::get('/admin/order/update', [OrderController::class, 'showOrders'])->name('order.update');
Route::put('admin/order/update/{id}', [OrderController::class, 'update'])->name('order.update');

// Route::put('/admin/order/{id}/update', [OrderController::class, 'update'])->name('order.update');
Route::get('/admin/orders', [OrderController::class, 'showOrders'])->name('admin.orders');

// Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('admin.order.update');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('/browse-products', [ProductController::class, 'browse'])->name('browse.products');
Route::get('/browse-products', [ProductController::class, 'filter'])->name('products.filter');
// routes/web.php
Route::get('/navbar', function () {
    return view('navbar');
});
Route::get('/navbar', [CategoryController::class, 'showForm'])->name('navbar.show');
