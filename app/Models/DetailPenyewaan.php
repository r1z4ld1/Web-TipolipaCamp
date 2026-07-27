<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'barang_id',
        'jumlah',
        'harga_sewa',
        'subtotal',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}