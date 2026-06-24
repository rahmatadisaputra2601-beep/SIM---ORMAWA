<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Kita daftarkan semua kolom agar diizinkan masuk ke database
    protected $fillable = [
        'ormawa_id',
        'tanggal',
        'keterangan',
        'jenis',
        'nominal',
        'bukti_nota',
    ];

    // Relasi balik ke Ormawa (Biar transaksi tahu ini milik ormawa mana)
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id');
    }
}