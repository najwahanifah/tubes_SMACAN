<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TongSampah extends Model
{
    protected $table = 'tong_sampah';
protected $fillable = ['nama_tong','lokasi','status','persentase_terisi'];
public function laporan() { return $this->hasMany(LaporanSampah::class, 'tong_id'); }
}
