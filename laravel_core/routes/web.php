<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/producto/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/buscar', [ProductController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::get('/pagar', [CartController::class, 'pay'])->name('cart.pay');
    Route::get('/pago', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/pago/confirmar', [CartController::class, 'confirmPayment'])->name('cart.confirm-payment');
    Route::get('/pedido/{codigo}/confirmacion', [CartController::class, 'confirmation'])->name('cart.confirmation');
    Route::get('/carrito/panel', [CartController::class, 'panel'])->name('cart.panel');
    Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
    Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
