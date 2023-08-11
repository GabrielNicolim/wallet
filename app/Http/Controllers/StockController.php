<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Operation;
use App\Models\Sector;
use App\Models\Stock;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StockController extends Controller
{
    public function create(Wallet $wallet)
    {
        $sectors =  Auth::user()->sectors;

        return Inertia::render('Stock/Create', [
            'wallet' => $wallet,
            'sectors' => $sectors,
        ]);
    }

    public function store(Wallet $wallet, StockRequest $request)
    {
        $name = $request->input('name');
        $averagePrice = $request->input('average_price');
        $ceilingPrice = $request->input('ceiling_price');
        $quantity = $request->input('quantity');
        $sectorId = $request->input('sector_id');

        $stock = $wallet
            ->stocks()
            ->where('name', 'like', $name . '%')
            ->first();

        if($stock) {
            $stock->update([
                'ceiling_price' => $ceilingPrice,
                'sector_id' => $sectorId,
            ]);
        }

        if(! $stock) {
            $stock = Stock::create([
                'name' => $name,
                'ceiling_price' => $ceilingPrice,
                'wallet_id' => $wallet->id,
                'sector_id' => $sectorId,
            ]);
        }

        if($averagePrice && $quantity) {
            Operation::create([
                'price' => $averagePrice,
                'quantity' => $quantity,
                'type' => Operation::PURCHASE,
                'stock_id' => $stock->id,
            ]);
        }

        $wallet->load('stocks');

        return Inertia::render('Wallet/Manage', [
            'wallet' => $wallet
        ]);
    }

    public function edit(Wallet $wallet, Stock $stock)
    {
        return Inertia::render('Stock/Edit', [
            'wallet' => $wallet,
            'stock' => $stock
        ]);
    }

    // public function update(Wallet $wallet, WalletRequest $request)
    // {
    //     // $wallet->update([
    //     //     'name' => $request->input('name'),
    //     // ]);

    //     // return redirect()->route('dashboard');
    // }
}
