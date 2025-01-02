<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index($id_adopsi)
    {
        $laporans = Laporan::where('user_id', Auth::id())
                            ->where('id_adopsi', $id_adopsi)
                            ->get();
    
        return view('LaporanUser.historiLapUser', compact('laporans'));
    }
}