<?php

namespace App\Http\Controllers;
use App\Models\Komen; 
use App\Models\Hewan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class homeusercontrol extends Controller
{
    public function index()
    {
        $hewans = Hewan::query()
        ->whereNotExists(function($query){
            $query->select('id_hewan')
            ->from('adopsi')
            ->whereRaw('hewan.id_hewan = adopsi.id_hewan')
            ->whereIn('status_adopsi', ['pending', 'Disetujui']);
        })
        ->take(10)
        ->get();
        
        
    $komentars = Komen::with(['user', 'admin', 'replies'])
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('homeuser', compact('komentars', 'hewans'));
    }
}
