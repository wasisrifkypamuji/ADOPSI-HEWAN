<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\KirimHewan;
use Illuminate\Http\Request;

class CheckDonationAccess
{
    public function handle(Request $request, Closure $next)
    {
        $donationId = $request->route('id');
        $donation = KirimHewan::findOrFail($donationId);
        
        if (auth()->check() && 
            (auth()->id() == $donation->user_id || auth()->guard('admin')->check())) {
            return $next($request);
        }
        
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
    }
}