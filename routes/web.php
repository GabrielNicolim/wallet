<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
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
        Route::get('/{wallet}/edit', [WalletController::class, 'edit'])->name('wallet.edit');
    });
});

require __DIR__.'/auth.php';
