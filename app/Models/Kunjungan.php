<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    protected $table = 'kunjungans';

    protected $fillable = [
        'user_id',
        'pasien_id',
        'poli_id',
        'tanggal_kunjungan',
        'keluhan',
        'jenis_pembayaran',
        'rujukan_dari',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kunjungan' => 'date',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function pemeriksaan(): HasOne
    {
        return $this->hasOne(Pemeriksaan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
