<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['nama','email','password','nis','kelas','sekolah','role','avatar','total_poin'];
    protected $hidden = ['password', 'remember_token'];

    public function laporan() { return $this->hasMany(LaporanSampah::class); }
    public function klaim()   { return $this->hasMany(EdukasiKlaim::class); }

    public function hitungLevel(): array
    {
        $poin = (int) $this->total_poin;
        return [
            'level'           => intdiv($poin, 500) + 1,
            'poin_saat_ini'   => $poin % 500,
            'poin_dibutuhkan' => 500,
            'poin_kurang'     => 500 - ($poin % 500),
            'persen_progress' => round(($poin % 500) / 500 * 100),
        ];
    }

    // dipakai di view: $user->initial  (pengganti getInitial())
    public function getInitialAttribute(): string
    {
        $i = collect(array_slice(explode(' ', trim($this->nama)), 0, 2))
            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
        return $i ?: 'U';
    }
}