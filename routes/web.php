<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\WalletBelongsToUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'wallets' => Auth::user()->wallets,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('wallet')->group(function () {
        Route::get('/create', [WalletController::class, 'create'])->name('wallet.create');
        Route::post('/', [WalletController::class, 'store'])->name('wallet.store');
        
        Route::middleware('walletBelongsToUser')->group(function () {
            Route::prefix('/{wallet}')->group(function () {
                Route::get('/edit', [WalletController::class, 'edit'])->name('wallet.edit');
                Route::put('/', [WalletController::class, 'update'])->name('wallet.update');
                Route::get('/manage', [WalletController::class, 'manage'])->name('wallet.manage');
            });
        });
    });
});

require __DIR__.'/auth.php';
