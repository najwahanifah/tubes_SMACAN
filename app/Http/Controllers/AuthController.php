<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse|JsonResponse
    {
        $cred = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($cred)) {
            $request->session()->regenerate();

            return $this->berhasil($request, 'Login berhasil!');
        }

        $pesan = 'Email atau password salah.';

        // Modal login di landing page memakai fetch() dan mengharapkan JSON
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => $pesan], 422);
        }

        return back()->withErrors(['email' => $pesan])->onlyInput('email');
    }

    public function register(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'nis'      => 'nullable|string|max:30',
            'kelas'    => 'nullable|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama'       => $data['nama'],
            'email'      => $data['email'],
            'nis'        => $data['nis'] ?? null,
            'kelas'      => $data['kelas'] ?? null,
            'password'   => Hash::make($data['password']),
            'role'       => 'siswa',
            'total_poin' => 0,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->berhasil($request, 'Registrasi berhasil! Selamat datang di SmaCan.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }

    /** Balasan sukses: JSON untuk modal landing, redirect biasa untuk form halaman. */
    private function berhasil(Request $request, string $pesan): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => $pesan,
                'redirect' => route('dashboard'),
            ]);
        }

        return redirect()->route('dashboard')->with('success', $pesan);
    }
}
