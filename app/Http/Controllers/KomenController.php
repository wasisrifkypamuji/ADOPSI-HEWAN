<?php

namespace App\Http\Controllers;
use App\Models\Komen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KomenController extends Controller
{
    public function reply(Request $request, $parent_id)
    {
        // Ganti pengecekan berdasarkan guard yang sedang aktif
    $isAdmin = Auth::guard('admin')->check();
    
    $request->validate([
        'komen' => 'required|string|max:1000',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
    ]);

    $reply = new Komen();

    if ($isAdmin) {
        // Jika yang login adalah admin
        $reply->id_admin = Auth::guard('admin')->id();
        $reply->username = 'Admin';
        $reply->user_id = null;
    } else {
        // Jika yang login adalah user biasa
        $reply->user_id = Auth::guard('web')->id();
        $reply->username = Auth::guard('web')->user()->username;
        $reply->id_admin = null;
    }

    $reply->komen = $request->komen;
    $reply->parent_id = $parent_id;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('komen/foto', 'public');
        $reply->foto = $foto;
    }

    if ($request->hasFile('video')) {
        $video = $request->file('video')->store('komen/video', 'public');
        $reply->video = $video;
    }

    $reply->save();

    return redirect()->back()->with('success', 'Balasan berhasil ditambahkan!');
    }
    
    

    public function destroy($id)
    {
            $komen = Komen::findOrFail($id);
        
        // Cek jika yang login adalah admin
        if (Auth::guard('admin')->check()) {
            // Admin bisa menghapus semua komentar/balasan
            if ($komen->foto) {
                Storage::disk('public')->delete($komen->foto);
            }
            if ($komen->video) {
                Storage::disk('public')->delete($komen->video);
            }
            
            $komen->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        } 
        // Cek jika yang login adalah user
        else if (Auth::guard('web')->check()) {
            // User hanya bisa menghapus komentar/balasan miliknya sendiri
            if ($komen->user_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda hanya dapat menghapus komentar/balasan Anda sendiri!');
            }
            
            // Hapus file terkait jika ada
            if ($komen->foto) {
                Storage::disk('public')->delete($komen->foto);
            }
            if ($komen->video) {
                Storage::disk('public')->delete($komen->video);
            }
            
            $komen->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
    }
    public function ambilKomentar()
{
    $komentars = Komen::with(['user', 'admin', 'replies'])
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('homeuser', compact('komentars'));
}
public function simpanKomentar(Request $request)
{
    $komen = new Komen();
    $komen->user_id = $request->user_id;
    $komen->id_admin = $request->id_admin;
    $komen->username = $request->username;
    $komen->komen = $request->komen;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('komen/foto', 'public');
        $komen->foto = $foto;
    }

    if ($request->hasFile('video')) {
        $video = $request->file('video')->store('komen/video', 'public');
        $komen->video = $video;
    }

    $komen->save();

    return redirect()->back()->with('success', 'Komentar berhasil disimpan!');
}
}
