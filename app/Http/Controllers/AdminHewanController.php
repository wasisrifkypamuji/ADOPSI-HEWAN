<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Kategori;
use App\Models\Komen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHewanController extends Controller
{
    // Tampilkan halaman homeadmin dengan data hewan dan komentar
    public function home()
    {
        $hewans = Hewan::all();
        $komentar = Komen::orderBy('created_at', 'desc')->get();
    
        return view('homeadmin', compact('hewans', 'komentar'));
    }

    public function show($id_hewan)
    {
        $hewan = Hewan::findOrFail($id_hewan);
        return view('adopsi.show', compact('hewan'));
    }

    // Simpan kategori
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'id_admin' => Auth::guard('admin')->id()
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // Hapus kategori
    public function deleteKategori($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    // Tambahkan data hewan
    public function storeHewan(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'ras' => 'required|string|max:255',
            'umur' => 'required|string',
            'gender' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fotoPath = $request->file('foto')->store('hewan', 'public');
        $kategori = Kategori::find($request->id_kategori);

        Hewan::create([
            'nama_hewan' => $request->nama_hewan,
            'id_kategori' => $request->id_kategori,
            'nama_kategori' => $kategori->nama_kategori,
            'id_admin' => Auth::guard('admin')->id(),
            'ras' => $request->ras,
            'umur' => $request->umur,
            'gender' => $request->gender,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status_adopsi' => 'Tersedia'
        ]);

        return redirect()->back()->with('success', 'Hewan berhasil ditambahkan');
    }

    // Tambahkan komentar
    public function storeKomentar(Request $request)
    {
        $request->validate([
            'komen' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
        ]);

        $foto = null;
        $video = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('uploads', 'public');
        }
        if ($request->hasFile('video')) {
            $video = $request->file('video')->store('uploads', 'public');
        }

        Komen::create([
            'user_id' => auth()->id() ?? null,
            'username' => auth()->user()->name ?? 'Anonim',
            'foto' => $foto,
            'video' => $video,
            'komen' => $request->komen,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    // Hapus komentar
    public function deleteKomentar($id)
    {
        Komen::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }

    public function replyKomentar(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|string|max:500',
        ]);

        // Cari komentar yang akan dibalas
        $komen = Komen::findOrFail($id);

        // Update kolom balasan
        $komen->update([
            'balasan' => $request->balasan,
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan!');
    }
}
