<?php

namespace App\Http\Controllers;

use App\Models\KirimHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccDonasiController extends Controller
{
    public function index()
    {
        $pending_donations = KirimHewan::with(['user', 'kategori'])
                                     ->latest()
                                     ->get();
        return view('admin.acc_donasi.index', compact('pending_donations'));
    }

    public function show($id)
    {
        $donation = KirimHewan::with(['user', 'kategori'])
                             ->findOrFail($id);
        return view('admin.acc_donasi.show', compact('donation'));
    }

    public function approve($id)
    {
        try {
            $donation = KirimHewan::findOrFail($id);
            
            $donation->update([
                'status' => 'disetujui',
                'id_admin' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->back()
                ->with('success', 'Donasi berhasil disetujui');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menyetujui donasi: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
{
    try {
        $donation = KirimHewan::findOrFail($id);
        
        $donation->update([
            'status' => 'ditolak',
            'id_admin' => Auth::guard('admin')->id(),
            'alasan_penolakan' => $request->alasan_penolakan  // Tambahkan ini
        ]);

        return redirect()
            ->back()
            ->with('success', 'Donasi ditolak');
            
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->with('error', 'Gagal menolak donasi: ' . $e->getMessage());
    }
}

    public function buktiTerima($id)
    {
        try {
            $donation = KirimHewan::with(['user', 'kategori'])
                                 ->findOrFail($id);

            if ($donation->status !== 'disetujui') {
                return redirect()->back()
                    ->with('error', 'Hanya donasi yang disetujui yang dapat mengunduh bukti terima');
            }

            return view('admin.acc_donasi.bukti_terima', compact('donation'));
            
        } catch (\Exception $e) {
            \Log::error('Error generating bukti terima:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->with('error', 'Gagal membuka bukti terima: ' . $e->getMessage());
        }
    }

    public function markAsCompleted($id)
    {
        try {
            $donation = KirimHewan::findOrFail($id);
            
            $donation->update([
                'status' => 'selesai'
            ]);

            return redirect()
                ->back()
                ->with('success', 'Donasi telah selesai diproses dan data hewan telah diupload');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menyelesaikan proses donasi: ' . $e->getMessage());
        }
    }

    public function checkDonationStatus($id)
    {
        try {
            $donation = KirimHewan::findOrFail($id);
            return response()->json([
                'status' => $donation->status
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}