<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use App\Models\LaporanSampah;
use App\Models\TongSampah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.index', [
            'user'     => $user,
            'statTong' => [
                'kosong' => TongSampah::where('status', 'kosong')->count(),
                'sedang' => TongSampah::where('status', 'sedang')->count(),
                'penuh'  => TongSampah::where('status', 'penuh')->count(),
                'total'  => TongSampah::count(),
            ],
            'levelInfo'      => $user->hitungLevel(),
            'laporanTerbaru' => LaporanSampah::with('tong')->latest()->take(3)->get(),
            'edukasiTerbaru' => Edukasi::latest()->take(1)->get(),
        ]);
    }
}
