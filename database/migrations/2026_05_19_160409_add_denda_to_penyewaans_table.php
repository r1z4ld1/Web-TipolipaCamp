<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->integer('terlambat_hari')->default(0)->after('lama_sewa');
            $table->decimal('denda_per_hari', 12, 2)->default(0)->after('terlambat_hari');
            $table->decimal('total_denda', 12, 2)->default(0)->after('denda_per_hari');
            $table->decimal('total_bayar', 12, 2)->default(0)->after('total_denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn([
                'terlambat_hari',
                'denda_per_hari',
                'total_denda',
                'total_bayar',
            ]);
        });
    }
};