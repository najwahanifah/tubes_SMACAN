<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /** Akun demo. Password semuanya: password123 */
    public function run(): void
    {
        $users = [
            ['Andi Saputra',    'andi.saputra@smacan.sch.id',    '2024001234', '11 IPA 2', 1250],
            ['Budi Rahayu',     'budi.rahayu@smacan.sch.id',     '2024001235', '11 IPA 1', 2100],
            ['Siti Fatimah',    'siti.fatimah@smacan.sch.id',    '2024001236', '11 IPA 2', 1850],
            ['Dewi Wulandari',  'dewi.wulandari@smacan.sch.id',  '2024001237', '11 IPS 1', 1100],
            ['Rizky Hidayat',   'rizky.hidayat@smacan.sch.id',   '2024001238', '11 IPS 2', 980],
        ];

        foreach ($users as [$nama, $email, $nis, $kelas, $poin]) {
            // updateOrCreate -> seeder aman dijalankan berulang kali
            User::updateOrCreate(
                ['email' => $email],
                [
                    'nama'       => $nama,
                    'password'   => Hash::make('password123'),
                    'nis'        => $nis,
                    'kelas'      => $kelas,
                    'role'       => 'siswa',
                    'total_poin' => $poin,
                ],
            );
        }
    }
}
