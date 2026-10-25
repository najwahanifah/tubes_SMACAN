<?php

return [
    'required'  => ':attribute wajib diisi.',
    'string'    => ':attribute harus berupa teks.',
    'email'     => 'Format :attribute tidak valid.',
    'unique'    => ':attribute sudah terdaftar.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'exists'    => ':attribute yang dipilih tidak valid.',
    'in'        => ':attribute yang dipilih tidak valid.',
    'image'     => ':attribute harus berupa gambar.',
    'mimes'     => ':attribute harus berformat: :values.',
    'uploaded'  => ':attribute gagal diunggah.',

    'max' => [
        'string' => ':attribute maksimal :max karakter.',
        'file'   => 'Ukuran :attribute maksimal :max KB.',
    ],
    'min' => [
        'string' => ':attribute minimal :min karakter.',
    ],

    'attributes' => [
        'nama'       => 'Nama',
        'email'      => 'Email',
        'password'   => 'Password',
        'nis'        => 'NIS',
        'kelas'      => 'Kelas',
        'tong_id'    => 'Lokasi tong',
        'status'     => 'Status',
        'keterangan' => 'Keterangan',
        'foto'       => 'Foto',
        'avatar'     => 'Foto profil',
    ],
];
