<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->date('tanggal_dikembalikan')->nullable()->after('tanggal_kembali');
            $table->enum('kondisi_pengembalian', [
                'baik',
                'rusak_ringan',
                'rusak_berat',
            ])->nullable()->after('tanggal_dikembalikan');
            $table->text('catatan_pengembalian')->nullable()->after('kondisi_pengembalian');
        });
    }

    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_dikembalikan',
                'kondisi_pengembalian',
                'catatan_pengembalian',
            ]);
        });
    }
};