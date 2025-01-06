<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function getUserId()
{
    return Auth::id();
}

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
            return redirect()->intended('/admin/homeadmin'); 
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

public function showForgotPasswordForm()
{
    return view('password.lupa_password'); // Buat view ini untuk form lupa password
}

public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Kirim tautan reset password ke email pengguna
    $status = Password::sendResetLink(
        $request->only('email')
    );

    // Tampilkan pesan berdasarkan status
    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
}

public function showResetPasswordForm($token)
{
    return view('password.reset_password', ['token' => $token]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
        'token' => 'required',
    ]);

    // Reset password pengguna
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) use ($request) {
            $user->forceFill([
                'password' => Hash::make($request->password),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}

}
