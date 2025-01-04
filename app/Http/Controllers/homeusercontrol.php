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
        $hewans = Hewan::with(['admin'])
        ->take(10)
        ->orderBy('created_at', 'desc')
        ->get();
        
    $komentars = Komen::with(['user', 'admin', 'replies'])
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('homeuser', compact('komentars', 'hewans'));
    }
}
