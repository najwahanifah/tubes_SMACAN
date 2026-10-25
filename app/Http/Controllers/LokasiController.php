<?php

namespace App\Http\Controllers;

use App\Models\TongSampah;

class LokasiController extends Controller
{
    public function index()
    {
        return view('lokasi.index', [
            'daftarTong' => TongSampah::orderBy('nama_tong')->get(),
        ]);
    }
}
