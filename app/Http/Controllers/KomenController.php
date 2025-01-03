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
        // Validasi user harus login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'komen' => 'required|string'
        ]);

        $reply = new Komen();
        $reply->user_id = Auth::id();
        $reply->id_admin = 1;
        $reply->username = Auth::user()->username;
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
        // Validasi user harus login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $komen = Komen::findOrFail($id);
        
        // Check if the authenticated user owns this comment
        if (Auth::id() !== $komen->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini!');
        }

        // Delete associated files if they exist
        if ($komen->foto) {
            Storage::disk('public')->delete($komen->foto);
        }
        if ($komen->video) {
            Storage::disk('public')->delete($komen->video);
        }

        $komen->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
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
