<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopsi; // Ubah dari Adoption ke Adopsi
use Illuminate\Support\Facades\Storage;

class AdopsiAdminController extends Controller
{
    public function index()
    {
        // Ubah Adoption menjadi Adopsi dan sesuaikan relasi
        $adoptions = Adopsi::with(['user', 'hewan', 'pertanyaan'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.acc_adopsi.permintaanadopsi', compact('adoptions'));
    }

    public function accept($id)
    {
        $adoption = Adopsi::findOrFail($id);
        // Tambahkan id_admin saat approval
        $adoption->id_admin = auth()->guard('admin')->id();
        $adoption->status_adopsi = 'Disetujui'; // Sesuaikan dengan status di sistem
        $adoption->save();

        return redirect()->route('admin.permintaanadopsi')
            ->with('success', 'Permintaan adopsi telah disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255'
        ]);

        $adoption = Adopsi::findOrFail($id);
        $adoption->id_admin = auth()->guard('admin')->id();
        $adoption->status_adopsi = 'Ditolak'; // Sesuaikan dengan status di sistem
        $adoption->alasan_penolakan = $request->alasan_penolakan;
        $adoption->save();

        return redirect()->route('admin.permintaanadopsi')
            ->with('success', 'Permintaan adopsi telah ditolak.');
    }

    public function viewForm($id)
    {
        $adoption = Adopsi::with(['user', 'hewan', 'pertanyaan'])
            ->findOrFail($id);

        return view('admin.acc_adopsi.viewForm', compact('adoption'));
    }
}