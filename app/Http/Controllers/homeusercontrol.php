<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeusercontrol extends Controller
{
    public function index()
    {
        return view('homeuser'); 
    }
}
