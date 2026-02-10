<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Saldo extends Model
{
    use HasFactory;
    protected $fillable = ['nama_e_wallet', 'total_saldo'];

    public function uangMasuk(): HasMany {
        return $this->hasMany(UangMasuk::class, 'id_saldo');
    }

    public function uangKeluar(): HasMany {
        return $this->hasMany(UangKeluar::class, 'id_saldo');
    }
}
