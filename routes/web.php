<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==================== ROUTE PUBLIK (GUEST) ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

// ==================== REDIRECT AFTER LOGIN ====================
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->name('dashboard');

// ==================== ROUTE UNTUK CUSTOMER ====================
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    
    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [User\ReservasiController::class, 'index'])->name('index');
        Route::get('/create/{kamar_id}', [User\ReservasiController::class, 'create'])->name('create');
        Route::post('/store', [User\ReservasiController::class, 'store'])->name('store');
        Route::get('/{id}', [User\ReservasiController::class, 'show'])->name('show');
        Route::delete('/{id}', [User\ReservasiController::class, 'cancel'])->name('cancel');
    });
    
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::patch('/upload/{reservasi_id}', [User\PembayaranController::class, 'upload'])->name('upload');
    });
});

// ==================== ROUTE UNTUK ADMIN ====================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('type-kamar', Admin\TypeKamarController::class);
    Route::resource('kamar', Admin\KamarController::class);
    
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [Admin\ReservasiController::class, 'index'])->name('index');
        Route::get('/{id}', [Admin\ReservasiController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [Admin\ReservasiController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{id}/verify-payment', [Admin\ReservasiController::class, 'verifyPayment'])->name('verify-payment');
    });
    
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [Admin\PembayaranController::class, 'index'])->name('index');
        Route::patch('/{id}/verify', [Admin\PembayaranController::class, 'verify'])->name('verify');
        Route::patch('/{id}/reject', [Admin\PembayaranController::class, 'reject'])->name('reject');
    });
});

// ==================== AUTH ROUTES ====================
require __DIR__.'/auth.php';