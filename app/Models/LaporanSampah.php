<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampah';
protected $fillable = ['user_id','tong_id','status','keterangan','foto','poin_didapat'];
public function user() { return $this->belongsTo(User::class); }
public function tong() { return $this->belongsTo(TongSampah::class, 'tong_id'); }
}
