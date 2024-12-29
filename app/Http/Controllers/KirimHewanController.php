<?php

namespace App\Http\Controllers;

use App\Models\KirimHewan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
{
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

    // Handle file uploads
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('hewan/foto', 'public');
        $validated['foto'] = $foto;
    }

    if ($request->hasFile('video')) {
        $video = $request->file('video')->store('hewan/video', 'public');
        $validated['video'] = $video;
    }

    if ($request->hasFile('surat_perjanjian')) {
        $suratPerjanjian = $request->file('surat_perjanjian')->store('hewan/dokumen', 'public');
        $validated['surat_perjanjian'] = $suratPerjanjian;
    }

    if ($request->hasFile('surat_keterangan_sehat')) {
        $suratSehat = $request->file('surat_keterangan_sehat')->store('hewan/dokumen', 'public');
        $validated['surat_keterangan_sehat'] = $suratSehat;
    }

    // Get kategori name
    $kategori = Kategori::find($request->id_kategori);
    $validated['nama_kategori'] = $kategori->nama_kategori;
    
    // Add user ID and status
    $validated['user_id'] = auth()->id();
    $validated['status'] = 'proses';

    // Create the donation
    KirimHewan::create($validated);

    return redirect()->route('donasi.index')
        ->with('success', 'Hewan berhasil didonasikan!');
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
