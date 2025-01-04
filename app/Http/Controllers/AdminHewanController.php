<?php

namespace App\Http\Controllers;

use App\Models\Adopsi;
use App\Models\Hewan;
use App\Models\Kategori;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHewanController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.tambah-hewan', compact('kategori'));
    }

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

    public function deleteKategori($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

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

        // Check if hewan already exists
        $exists = Hewan::where('nama_hewan', $request->nama_hewan)
            ->where('id_kategori', $request->id_kategori)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Hewan ini sudah ada dalam daftar adopsi');
        }

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

    public function adoptions(Request $request)
    {
        $query = Hewan::query();

        if ($request->filled('jenis_hewan')) {
            $query->where('nama_kategori', $request->jenis_hewan);
        }
        if ($request->filled('jenis_kelamin')) {
            $query->where('gender', $request->jenis_kelamin);
        }
        if ($request->filled('usia')) {
            $query->where('umur', $request->usia);
        }

        $hewan = $query->paginate(12);
        $kategori = Kategori::select('nama_kategori')->distinct()->get();

        return view('admin.adopsi', compact('hewan', 'kategori'));
    }

    public function riwayatAdopsi()
    {
        $adopsi = Adopsi::with('hewan')->where('id_admin', Auth::guard('admin')->id())->paginate(12);
        return view('admin.riwayat-adopsi', compact('adopsi'));
    }

    public function deleteAdoption($id)
    {
        Hewan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Hewan berhasil dihapus');
    }

    public function report($id)
    {
        $laporan = Laporan::with('adopsi')->where('id_adopsi', $id)->paginate(10);
        $adopsi = Adopsi::findOrFail($id);

        return view('admin.laporan', compact('laporan', 'adopsi'));
    }
}
