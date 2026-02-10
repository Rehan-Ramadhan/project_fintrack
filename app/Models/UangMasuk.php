<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'id_saldo', 'nominal', 'keterangan', 'tanggal_masuk'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function saldo(): BelongsTo
    {
        return $this->belongsTo(Saldo::class, 'id_saldo');
    }
}
