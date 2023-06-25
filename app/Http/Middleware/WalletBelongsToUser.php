<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class WalletBelongsToUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $walletsIds = Auth::user()->wallets->pluck('id');

        if (! $walletsIds->contains($request->route('wallet')->id)) {
            return redirect(route('dashboard'));
        }

        return $next($request);
    }
}
