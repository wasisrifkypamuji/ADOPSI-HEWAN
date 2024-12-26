<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect()->intended('homeuser'); 
        } else {
            // Login gagal
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login.form');
    }
}
