<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Support\Facades\Auth;

class EdukasiController extends Controller
{
    public function index()
    {
        $uid = Auth::id();

        $daftarEdukasi = Edukasi::latest()
            ->withExists(['klaim as sudah_klaim' => fn ($q) => $q->where('user_id', $uid)])
            ->get();

        return view('edukasi.index', compact('daftarEdukasi'));
    }
}
