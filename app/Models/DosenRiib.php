<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenRiib extends Model
{
    protected $table = 'dosen_riib';

    public $timestamps = false;

    protected $fillable = [
        'kode_dosen',
        'nama_dosen',
        'prodi',
        'kk',
        'jad',
        'sub_kk',
        'pendidikan_terakhir',
        'tahun_masuk',
        'sedang_studi_lanjut',
        'nidn',
        'nip',
        'CoE',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
        'sedang_studi_lanjut' => 'boolean',
    ];
}
