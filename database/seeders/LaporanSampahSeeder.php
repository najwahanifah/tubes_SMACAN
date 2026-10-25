<?php

namespace Database\Seeders;

use App\Models\LaporanSampah;
use App\Models\TongSampah;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanSampahSeeder extends Seeder
{
    public function run(): void
    {
        // Jangan dobel-seed kalau tabel sudah berisi data
        if (LaporanSampah::exists()) {
            return;
        }

        $userIds = User::pluck('id')->all();
        $tongIds = TongSampah::pluck('id')->all();

        if (! $userIds || ! $tongIds) {
            return;
        }

        $contoh = [
            ['penuh',  'Tong sudah penuh sejak pagi, perlu segera dikosongkan.'],
            ['sedang', 'Terisi sekitar setengah, masih aman untuk beberapa jam.'],
            ['kosong', 'Baru saja dikosongkan oleh petugas kebersihan.'],
            ['penuh',  null],
            ['sedang', 'Banyak sampah plastik bekas minuman.'],
            ['kosong', null],
            ['penuh',  'Sampah mulai tumpah ke luar tong.'],
            ['sedang', null],
        ];

        foreach ($contoh as $i => [$status, $keterangan]) {
            LaporanSampah::create([
                'user_id'      => $userIds[$i % count($userIds)],
                'tong_id'      => $tongIds[$i % count($tongIds)],
                'status'       => $status,
                'keterangan'   => $keterangan,
                'foto'         => null,
                'poin_didapat' => 5,
            ]);
        }
    }
}
