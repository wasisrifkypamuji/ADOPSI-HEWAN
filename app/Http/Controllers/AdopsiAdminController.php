<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopsi;
use App\Models\Hewan; // Pastikan model Hewan diimport
use Illuminate\Support\Facades\Storage;

class AdopsiAdminController extends Controller
{
    public function index()
    {
        $adoptions = Adopsi::with(['user', 'hewan', 'pertanyaan'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.acc_adopsi.permintaanadopsi', compact('adoptions'));
    }

    public function accept($id)
    {
        $adoption = Adopsi::findOrFail($id);
        $adoption->id_admin = auth()->guard('admin')->id();
        $adoption->status_adopsi = 'Disetujui';
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
        $adoption->status_adopsi = 'Ditolak';
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

    public function edit($id)
    {
        $hewan = Hewan::findOrFail($id);

        // Mengembalikan data hewan dalam format JSON (opsional)
        return response()->json($hewan);
    }

    public function update(Request $request, $id)
    {
        // Cari data hewan berdasarkan ID
        $hewan = Hewan::findOrFail($id);
    
        // Validasi data
        $validatedData = $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'usia' => 'required|numeric|min:0',
            'jenis_kelamin' => 'required|string|in:Jantan,Betina',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Jika ada file foto baru, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            if ($hewan->foto && Storage::exists('public/' . $hewan->foto)) {
                Storage::delete('public/' . $hewan->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('hewan', 'public');
        }
    
        // Update data hewan
        $hewan->update($validatedData);
    
        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.adopsi.index')->with('success', 'Data hewan berhasil diperbarui.');
    }    
}
