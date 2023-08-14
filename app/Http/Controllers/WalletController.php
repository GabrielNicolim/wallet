<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use App\Repositories\PortfolioRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WalletController extends Controller
{
    protected $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function create()
    {
        return Inertia::render('Wallet/Create');
    }

    public function store(WalletRequest $request)
    {
        $wallet = Wallet::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
        ]);

        return Inertia::render('Wallet/Manage', [
            'wallet' => $wallet
        ]);
    }

    public function edit(Wallet $wallet)
    {
        return Inertia::render('Wallet/Edit', [
            'wallet' => $wallet
        ]);
    }

    public function update(Wallet $wallet, WalletRequest $request)
    {
        $wallet->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('dashboard');
    }

    public function manage(Wallet $wallet)
    {
        $wallet->load('stocks');

        return Inertia::render('Wallet/Manage', [
            'wallet' => $wallet,
            'consolidatedPortfolio' => $this->portfolioRepository->getConsolidatedPortfolio($wallet),
            'sectorPortfolio' => $this->portfolioRepository->getSectorPortfolio($wallet),
        ]);
    }
}
