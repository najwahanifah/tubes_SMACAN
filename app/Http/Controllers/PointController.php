<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        return view('point.index', [
            'user'        => Auth::user(),
            'levelInfo'   => Auth::user()->hitungLevel(),
            'leaderboard' => User::where('role', 'siswa')->orderByDesc('total_poin')->limit(10)->get(),
        ]);
    }
}
