<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function create()
    {
        return Inertia::render('Wallet/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
        ], [
           'name.required' => 'O campo nome é obrigatório.',
           'name.max' => 'O campo nome não pode ter mais de 64 caracteres.' 
        ]);

        $wallet = Wallet::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
        ]);

        return Inertia::render('Wallet/Edit', [
            'wallet' => $wallet
        ]);
    }

    public function edit(Wallet $wallet)
    {
        $wallet->load('stocks');

        return Inertia::render('Wallet/Edit', [
            'wallet' => $wallet
        ]);
    }
}
