<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function edit(Wallet $wallet)
    {
        $wallet->load('stocks');

        return Inertia::render('Wallet/Edit', [
            'wallet' => $wallet
        ]);
    }
}
