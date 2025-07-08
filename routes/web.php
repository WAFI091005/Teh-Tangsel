<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentAccountController;
use App\Http\Controllers\FavoriteController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::get('/menu', [ProductController::class, 'index'])->name('menu.index');
    Route::get('/menu/{id}', [ProductController::class, 'show'])->name('menu.show');
    Route::get('/product-detail/{id}', [ProductController::class, 'show'])->name('product.detail'); // alias tambahan
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.store');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    

    Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [PaymentController::class, 'process'])->name('checkout.process');
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('auth')->get('/profil', function () {
    return view('profile', ['user' => Auth::user()]);
})->name('profil');

    
});

Route::get('/checkout/success', function () {
    return view('checkout-success');
})->name('checkout.success')->middleware('auth');

Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');

Route::get('/payment-account/create', [PaymentAccountController::class, 'create'])->name('payment-account.create');
Route::post('/payment-account/store', [PaymentAccountController::class, 'store'])->name('payment-account.store');

Route::get('/orders', [OrderController::class, 'list'])->name('orders.list')->middleware('auth');
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus')->middleware('auth');
Route::get('/aktivitas', [OrderController::class, 'aktivitas'])->name('aktivitas');

Route::post('/favorite/toggle/{product}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth')->name('favorites.index');


require __DIR__.'/auth.php';