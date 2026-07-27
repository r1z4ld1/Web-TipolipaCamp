<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'order_id',
        'metode_pembayaran',
        'jumlah',
        'status',
        'transaction_id',
        'snap_token',
        'paid_at',
        'raw_response',
    ];

    protected $casts = [
        'raw_response' => 'array',
        'paid_at' => 'datetime',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
