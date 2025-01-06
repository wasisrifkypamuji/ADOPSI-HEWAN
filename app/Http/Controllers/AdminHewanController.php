<?php

namespace App\Http\Controllers;

use App\Models\Adopsi;
use App\Models\Hewan;
use App\Models\Kategori;
use App\Models\Komen;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\KirimHewan;

class AdminHewanController extends Controller
{
    // Tampilkan halaman homeadmin dengan data hewan dan komentar
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.tambah-hewan', compact('kategori'));
    }

    public function home()
    {
        $hewans = Hewan::all();
        $komentars = Komen::whereNull('parent_id') // Hanya komentar utama
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('homeadmin', compact('hewans', 'komentars'));
    }

    public function show($id_hewan)
    {
        $hewan = Hewan::findOrFail($id_hewan);
        return view('adopsi.show', compact('hewan'));
    }

    public function detail($id_hewan)
    {
        $hewan = Hewan::findOrFail($id_hewan);
    
        // Pastikan Anda merujuk ke lokasi folder views/admin/detailhewan.blade.php
        return view('admin.detailhewan', compact('hewan'));
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
        try {
            // Validasi dasar
            $baseValidation = [
                'nama_hewan' => 'required|string|max:255',
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'ras' => 'required|string|max:255',
                'umur' => 'required|integer|min:0',
                'gender' => 'required|in:Jantan,Betina',
                'deskripsi' => 'required|string',
            ];

            // Tambahkan validasi untuk foto berdasarkan kasus
            if ($request->has('existing_foto')) {
                $baseValidation['existing_foto'] = 'required';
            } else {
                $baseValidation['foto'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
            }

            $validated = $request->validate($baseValidation);

            // Cek apakah hewan sudah ada
            $exists = Hewan::where('nama_hewan', $request->nama_hewan)
                ->where('id_kategori', $request->id_kategori)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Hewan ini sudah ada dalam daftar adopsi');
            }

            // Handle foto
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $fotoPath = $foto->storeAs('hewan', $fotoName, 'public');
            } else {
                $fotoPath = $request->existing_foto;
            }

            // Data untuk hewan
            $kategori = Kategori::findOrFail($request->id_kategori);
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

            // Simpan data hewan
            $hewan = Hewan::create($hewanData);

            // Update status donasi jika foto berasal dari form donasi
            if ($hewan && $request->has('existing_foto')) {
                KirimHewan::where('foto', $request->existing_foto)
                    ->update(['status' => 'selesai']);
            }

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
