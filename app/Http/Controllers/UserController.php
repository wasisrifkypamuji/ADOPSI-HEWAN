<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function handleSignup(Request $request)
    {
        $request->validate([
        'username' => 'required|string|max:255',
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'no_telepon' => 'required|string|max:15',
        'alamat' => 'required|string',
        'media_sosial' => 'nullable|string|max:255',
        'usia' => 'required|integer|min:1',
        'pekerjaan' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed', 
        ]);

        User::create([
        'username' => $request->username,
        'nama_lengkap' => $request->nama_lengkap,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'alamat' => $request->alamat,
        'media_sosial' => $request->media_sosial,
        'usia' => $request->usia,
        'pekerjaan' => $request->pekerjaan,
        'password' => bcrypt($request->password), 
        ]);

        return redirect()->route('signup.form')->with('success', 'You have successfully registered!');
    }
}
