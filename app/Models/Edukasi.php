<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    protected $table = 'edukasi';
protected $fillable = ['judul','ringkasan','konten','waktu_baca','poin','icon_type'];
public function klaim() { return $this->hasMany(EdukasiKlaim::class, 'edukasi_id'); }
}
