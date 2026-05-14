<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenagaKesehatan extends Model
{
    protected $table = 'tenaga_kesehatans';

    protected $fillable = [
        'user_id',
        'jenis',
        'poli_id',
        'no_str',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
