<?php

namespace App\Http\Controllers;

use App\Models\KirimHewan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KirimHewanController extends Controller
{
    public function index()
    {
        $donations = KirimHewan::with(['user', 'kategori'])
                          ->whereHas('user', function($query) {
                              $query->where('user_id', auth()->id());
                          })
                          ->latest()
                          ->get();
    
    return view('donasi.donasi', compact('donations'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('donasi.formulirdonasi', compact('categories'));
    }

    // Di KirimHewanController.php, method store():

public function store(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_hewan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'usia' => 'required|string',
            'gender' => 'required|in:Jantan,Betina',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
            'surat_perjanjian' => 'required|mimes:pdf|max:2048',
            'surat_keterangan_sehat' => 'required|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        
        // Handle file uploads
        $fileFields = ['foto', 'video', 'surat_perjanjian', 'surat_keterangan_sehat'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $folder = $field === 'foto' || $field === 'video' ? "hewan/$field" : 'hewan/dokumen';
                $validated[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        // Get kategori name
        $kategori = Kategori::findOrFail($request->id_kategori);
        $validated['nama_kategori'] = $kategori->nama_kategori;
        
        // Add user ID and status
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        // Create donation record
        KirimHewan::create($validated);

        DB::commit();

        return redirect()->route('donasi.index')
            ->with('success', 'Hewan berhasil didonasikan! Mohon tunggu proses verifikasi dari admin.');

    } catch (\Exception $e) {
        DB::rollBack();
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}
    public function show($id)
    {
        $donation = KirimHewan::with(['user', 'kategori'])->findOrFail($id);
        return view('donasi.show', compact('donation'));
    }

    public function batalkan($id)
{
    $donation = KirimHewan::findOrFail($id);
    // Tambahkan logika pembatalan sesuai kebutuhan
    $donation->delete();

    return redirect()->back()->with('success', 'Donasi berhasil dibatalkan');
}
}
