<?php

namespace App\Http\Controllers;

use App\Models\KirimHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        // Generate bukti terima PDF
        $buktiPath = 'public/bukti_terima/'.$id.'.pdf';
        
        // Generate bukti terima content (you'll need to create this view)
        $pdf = PDF::loadView('admin.acc_donasi.bukti_terima', compact('donation'));
        Storage::put($buktiPath, $pdf->output());
        
        $donation->update([
            'status' => 'disetujui',
            'id_admin' => Auth::guard('admin')->id(),
            'bukti_terima' => $buktiPath
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

    

    public function buktiTerima($id)
    {
        try {
            $donation = KirimHewan::with(['user', 'kategori'])->findOrFail($id);
    
            if (!in_array($donation->status, ['disetujui', 'selesai'])) {
                return redirect()->back()
                    ->with('error', 'Bukti hanya tersedia untuk donasi yang disetujui atau selesai.');
            }
    
            $pdf = PDF::loadView('admin.acc_donasi.bukti_terima', compact('donation'))
                      ->setPaper('a4', 'portrait')
                      ->setOptions([
                          'isHtml5ParserEnabled' => true,
                          'isRemoteEnabled' => true,
                          'isJavascriptEnabled' => true
                      ]);
    
            return $pdf->stream('bukti_terima_donasi_'.$donation->id_kirim.'.pdf', [
                'Attachment' => false
            ]);
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

public function downloadBuktiTerima($id)
{
    try {
        $donation = KirimHewan::with(['user', 'kategori'])->findOrFail($id);

        if (!in_array($donation->status, ['disetujui', 'selesai'])) {
            return redirect()->back()
                ->with('error', 'Bukti hanya tersedia untuk donasi yang disetujui atau selesai.');
        }

        $pdf = PDF::loadView('admin.acc_donasi.bukti_terima', compact('donation'));
        return $pdf->download('bukti_terima_donasi_'.$donation->id_kirim.'.pdf');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error: ' . $e->getMessage());
    }
}
}