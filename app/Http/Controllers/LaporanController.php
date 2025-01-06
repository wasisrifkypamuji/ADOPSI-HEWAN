<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index($id_adopsi)
    {
        $laporans = Laporan::where('user_id', Auth::id())
            ->where('id_adopsi', $id_adopsi)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('LaporanUser.historiLapUser', compact('laporans', 'id_adopsi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'video' => 'nullable|mimetypes:video/mp4|max:20480'
        ]);

        $data = [
            'user_id' => Auth::id(),
            'id_adopsi' => $request->id_adopsi,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan/foto', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('laporan/video', 'public');
        }

        Laporan::create($data);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        if ($laporan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }
        
        if ($laporan->video) {
            Storage::disk('public')->delete($laporan->video);
        }

        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }
}