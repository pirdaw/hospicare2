<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasiens';

    protected $fillable = [
        'nama',
        'nik',
        'umur',
        'jenis_kelamin',
        'golongan_darah',
        'agama',
        'alamat',
        'pekerjaan',
        'no_hp',
    ];

    public function kunjungans(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }
}
