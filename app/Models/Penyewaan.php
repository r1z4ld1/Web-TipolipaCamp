<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_penyewaan',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'lama_sewa',
        'terlambat_hari',
        'denda_per_hari',
        'total_denda',
        'total_bayar',
        'total_harga',
        'bukti_identitas',
        'status',
        'catatan',
        'kondisi_pengembalian',
        'catatan_pengembalian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPenyewaan::class);
    }

     public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pembayaranAktif()
    {
        return $this->hasOne(Pembayaran::class)->latestOfMany();
    }
}
