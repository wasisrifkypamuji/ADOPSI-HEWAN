<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Adopsi;
use App\Models\Pertanyaan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;


class AdopsiController extends Controller
{
    public function index(Request $request)
{
    // Start with base query
    $query = Hewan::query()
        ->whereNotExists(function($query) {
            $query->select('id_hewan')
                  ->from('adopsi')
                  ->whereRaw('hewan.id_hewan = adopsi.id_hewan')
                  ->whereIn('status_adopsi', ['pending', 'Disetujui']);
        });
    
    // Apply filters
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
    public function create($id) 
    {
        $hewan = Hewan::findOrFail($id);
        return view('adopsi.create', compact('hewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'q1' => 'required',
            'q2' => 'required', 
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
            'q6' => 'required',
            'q7' => 'required',
            'q8' => 'required',
            'q9' => 'required',
            'surat_perjanjian' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('surat_perjanjian')->store('surat_perjanjian', 'public');
        $hewan = Hewan::findOrFail($request->id_hewan);

        // Simpan pertanyaan
        $pertanyaan = Pertanyaan::create([
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,
            'q5' => $request->q5,
            'q6' => $request->q6,
            'q7' => $request->q7,
            'q8' => $request->q8,
            'q9' => $request->q9,
            'surat_perjanjian' => $path
        ]);

        // Simpan data adopsi
        $adopsi = Adopsi::create([
            'id_admin' => 1,
            'user_id' => auth()->id(),
            'username' => auth()->user()->username,
            'nama_lengkap' => auth()->user()->nama_lengkap,
            'email' => auth()->user()->email,
            'no_telepon' => auth()->user()->no_telepon,
            'alamat' => auth()->user()->alamat,
            'pekerjaan' => auth()->user()->pekerjaan,
            'id_hewan' => $request->id_hewan,
            'nama_hewan' => $hewan->nama_hewan,
            'id_pertanyaan' => $pertanyaan->id_pertanyaan,
            'status_adopsi' => 'pending'
        ]);

        return redirect()->route('adopsi.my-adoptions')
            ->with('success', 'Form pengajuan adopsi berhasil dikirim! Tunggu konfirmasi dari Admin');
    }


    public function userAdoptions()
{
    $adoptions = Adopsi::with('hewan')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('adopsi.adopsiMu', compact('adoptions'));
}

public function cancel($id)
{
    $adopsi = Adopsi::where('user_id', auth()->id())
        ->where('id_adopsi', $id)
        ->where('status_adopsi', 'pending')
        ->firstOrFail();
        
    $adopsi->delete();
    
    return redirect()->back()->with('success', 'Pengajuan adopsi berhasil dibatalkan');
}

public function downloadPdf($id)
{
    $adoption = Adopsi::with('hewan')->findOrFail($id);

    if ($adoption->status_adopsi !== 'Disetujui') {
        return redirect()->back()->with('error', 'Bukti adopsi hanya tersedia untuk pengajuan yang disetujui.');
    }

    $data = [
         'adoption' => $adoption
    ];

    $pdf = Pdf::loadView('pdf.bukti_adopsi', $data);
    return $pdf->stream('bukti_adopsi_'.$adoption->id_adopsi.'.pdf');
}
public function viewForm($id)
{
    $adoption = Adopsi::with(['hewan', 'user'])->where('user_id', auth()->id())->where('id_adopsi', $id)->firstOrFail();
    return view('adopsi.infoAdopsi', compact('adoption'));
}

}
