<?php

use App\Models\Barang;
use App\Models\Penyewaan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penyewaans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Penyewaan::class)
                ->constrained('penyewaans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Barang::class)
                ->constrained('barangs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->integer('jumlah')->default(1);
            $table->decimal('harga_sewa', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaans');
    }
};