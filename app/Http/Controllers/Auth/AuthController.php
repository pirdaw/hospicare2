<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role->nama_role);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();

        $role = Auth::user()->role->nama_role;

        return $this->redirectByRole($role);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin' => redirect()->route('dashboard.admin'),
            'petugas_pendaftaran' => redirect()->route('dashboard.petugas'),
            'tenaga_kesehatan' => redirect()->route('dashboard.nakes'),
            'kepala_rm' => redirect()->route('dashboard.kepala'),
            default => redirect()->route('login')
                ->withErrors(['email' => 'Role tidak dikenali.']),
        };
    }
}
