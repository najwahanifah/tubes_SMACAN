<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', [
            'user'          => $user,
            'levelInfo'     => $user->hitungLevel(),
            'artikelDibaca' => $user->klaim()->count(),
            'tanggalGabung' => $user->created_at->translatedFormat('F Y'),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,'.$user->id,
            'nis'   => 'nullable|string|max:30',
            'kelas' => 'nullable|string|max:50',
        ]);

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('avatar');
        $nama = 'avatar_'.$user->id.'_'.time().'.'.$file->extension();

        $file->move(public_path('uploads/avatar'), $nama);

        if ($user->avatar) {
            @unlink(public_path('uploads/avatar/'.$user->avatar));
        }
        $user->update(['avatar' => $nama]);

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
