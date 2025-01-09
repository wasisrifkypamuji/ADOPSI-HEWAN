<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class admincontrol extends Controller
{
    public function showAddAdminForm()
    {
        if (Auth::user()->id_admin != 1) {
            return redirect('/admin/homeadmin'); 
        }
        return view('tambahadmin');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admin,username|unique:users,username|min:3',
            'email' => 'required|email|unique:admin,email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Admin::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password, 
            ]);

            return redirect('login')->with('success', 'Admin berhasil ditambahkan!');


        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan admin.')
                ->withInput();
        }
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function permintaanAdopsi()
{
    return view('admin.permintaan-adopsi.index');
}
}
