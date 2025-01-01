<?php

namespace App\Http\Controllers;

use App\Models\KirimHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccDonasiController extends Controller
{
    // Menampilkan semua donasi yang perlu di-approve
    public function index()
    {
        $pending_donations = KirimHewan::where('status', 'pending')
                                     ->with(['user', 'kategori'])
                                     ->latest()
                                     ->get();
        return view('admin.acc_donasi.index', compact('pending_donations'));
    }

    // Menampilkan detail donasi
    public function show($id)
    {
        $donation = KirimHewan::with(['user', 'kategori'])
                             ->findOrFail($id);
        return view('admin.acc_donasi.show', compact('donation'));
    }

    // Menyetujui donasi
    public function approve($id)
    {
        try {
            $donation = KirimHewan::findOrFail($id);
            
            $donation->update([
                'status' => 'disetujui',
                'id_admin' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->route('acc-donasi.index')
                ->with('success', 'Donasi berhasil disetujui');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menyetujui donasi: ' . $e->getMessage());
        }
    }

    // Menolak donasi
    public function reject($id, Request $request)
    {
        try {
            $donation = KirimHewan::findOrFail($id);
            
            $donation->update([
                'status' => 'ditolak',
                'id_admin' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->route('acc-donasi.index')
                ->with('success', 'Donasi ditolak');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menolak donasi: ' . $e->getMessage());
        }
    }
}