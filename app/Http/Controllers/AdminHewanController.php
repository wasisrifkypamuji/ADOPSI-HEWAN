<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Kategori;
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

        public function store(Request $request)
    {
        try {
            // Check if hewan already exists
            $exists = Hewan::where('nama_hewan', $request->nama_hewan)
                        ->where('foto', $request->foto)
                        ->exists();
                        
            if ($exists) {
                return redirect()
                    ->back()
                    ->with('error', 'Hewan ini sudah ada dalam daftar adopsi');
            }

            // Proceed with creating new hewan
            $hewan = Hewan::create([
                'id_admin' => Auth::guard('admin')->id(),
                'id_kategori' => $request->id_kategori,
                'nama_kategori' => $request->nama_kategori,
                'nama_hewan' => $request->nama_hewan,
                'umur' => $request->umur,
                'gender' => $request->gender,
                'ras' => '-', // Sesuaikan dengan kebutuhan
                'deskripsi' => $request->deskripsi,
                'foto' => $request->foto,
                'status_adopsi' => $request->status_adopsi
            ]);

            return redirect()
                ->back()
                ->with('success', 'Hewan berhasil ditambahkan ke daftar adopsi');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan hewan: ' . $e->getMessage());
        }
    }

}