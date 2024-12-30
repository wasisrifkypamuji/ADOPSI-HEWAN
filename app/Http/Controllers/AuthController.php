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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        //login atmin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            //GANTIIIII login admin ke homeadmin
            return back()->withErrors(['username' => 'yey login admin berhasil']);
        }
        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect()->intended('homeuser'); 
        } else {
            // Login gagal
            return back()->withErrors(['username' => 'Invalid username or password.']);
        }
    }
    public function logout(Request $request)
    {
        // Logout admin jika login menggunakan guard 'admin'
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            // Logout pengguna biasa
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
