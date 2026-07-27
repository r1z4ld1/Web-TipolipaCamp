<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'slug',
        'deskripsi',
        'harga_sewa',
        'stok',
        'kondisi',
        'status',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detailPenyewaans()
    {
        return $this->hasMany(DetailPenyewaan::class);
    }
}