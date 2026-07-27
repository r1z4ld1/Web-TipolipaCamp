<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('kode_penyewaan', 50)->unique();
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('lama_sewa')->default(1);
            $table->decimal('total_harga', 12, 2)->default(0);

            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak',
                'selesai',
            ])->default('pending');

            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};