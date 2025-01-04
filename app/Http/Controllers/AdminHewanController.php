<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\KirimHewan;


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
    try {
        // Basic validation untuk kedua kasus
        $baseValidation = [
            'nama_hewan' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'ras' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'gender' => 'required|in:Jantan,Betina',
            'deskripsi' => 'required|string',
        ];

        // Tambahkan validasi foto berdasarkan skenario
        if ($request->has('existing_foto')) {
            // Kasus dari donasi
            $baseValidation['existing_foto'] = 'required';
        } else {
            // Kasus tambah manual
            $baseValidation['foto'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validated = $request->validate($baseValidation);

        // Get kategori
        $kategori = Kategori::findOrFail($request->id_kategori);

        // Handle foto
        if ($request->hasFile('foto')) {
            // Kasus tambah manual
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('hewan', $fotoName, 'public');
        } else {
            // Kasus dari donasi
            $fotoPath = $request->existing_foto;
        }

        // Data dasar untuk create hewan
        $hewanData = [
            'nama_hewan' => $request->nama_hewan,
            'id_admin' => Auth::guard('admin')->id(),
            'id_kategori' => $kategori->id_kategori,
            'nama_kategori' => $kategori->nama_kategori,
            'ras' => $request->ras,
            'umur' => (int)$request->umur,
            'gender' => $request->gender,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status_adopsi' => 'Tersedia'
        ];

        // Create hewan
        $hewan = Hewan::create($hewanData);

        // Update status donasi jika ini dari form donasi
        if ($hewan && $request->has('existing_foto')) {
            KirimHewan::where('foto', $request->existing_foto)
                      ->update(['status' => 'selesai']);
        }

        // Debug log untuk membantu troubleshooting
        \Log::info('Hewan created successfully:', [
            'data' => $hewanData,
            'request_type' => $request->has('existing_foto') ? 'donasi' : 'manual'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Hewan berhasil ditambahkan');
            
    } catch (\Exception $e) {
        \Log::error('Error adding animal:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all()
        ]);
        
        return redirect()
            ->back()
            ->with('error', 'Gagal menambahkan hewan: ' . $e->getMessage())
            ->withInput();
    }
}

public function store(Request $request)
{
    try {
        // Check if hewan already exists
        $exists = Hewan::where('nama_hewan', $request->nama_hewan)
                    ->exists();
                    
        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Hewan ini sudah ada dalam daftar adopsi');
        }

        // Create new hewan directly with existing foto path
        $hewan = Hewan::create([
            'id_admin' => Auth::guard('admin')->id(),
            'id_kategori' => $request->id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'nama_hewan' => $request->nama_hewan,
            'umur' => $request->umur,
            'gender' => $request->gender,
            'ras' => '-', // Default value
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto, // Gunakan path foto yang sudah ada
            'status_adopsi' => $request->status_adopsi
        ]);

        // Update donation status to completed
        if ($hewan) {
            KirimHewan::where('foto', $request->foto)
                      ->update(['status' => 'selesai']);
        }

        return redirect()
            ->back()
            ->with('success', 'Hewan berhasil ditambahkan ke daftar adopsi');
            
    } catch (\Exception $e) {
        \Log::error('Error storing hewan:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all()
        ]);
        
        return redirect()
            ->back()
            ->with('error', 'Gagal menambahkan hewan: ' . $e->getMessage());
    }
}

}