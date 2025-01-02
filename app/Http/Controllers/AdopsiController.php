<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Kategori;

class AdopsiController extends Controller
{
    public function index(Request $request)
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
    
    return view('adopsi.index', compact('hewan', 'kategori'));
}

    public function show($id)
    {
        $hewan = Hewan::findOrFail($id);
        return view('adopsi.detail', compact('hewan')); 
    }
}
