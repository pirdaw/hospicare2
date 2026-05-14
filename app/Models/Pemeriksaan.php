<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaans';

    protected $fillable = [
        'kunjungan_id',
        'tenaga_kesehatan_id',
        'poli_id',
        'subjective',
        'objective',
        'suhu',
        'tensi',
        'nadi',
        'respirasi',
        'assessment',
        'plan',
        'tanggal_pemeriksaan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pemeriksaan' => 'datetime',
            'suhu'                => 'float',
            'nadi'                => 'integer',
            'respirasi'           => 'integer',
        ];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function tenagaKesehatan(): BelongsTo
    {
        return $this->belongsTo(TenagaKesehatan::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }
}
