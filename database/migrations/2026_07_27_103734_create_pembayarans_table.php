<?php

use App\Models\Penyewaan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Penyewaan::class)
                ->constrained('penyewaans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('order_id', 100)->unique();
            $table->string('metode_pembayaran', 50)->nullable();
            $table->decimal('jumlah', 12, 2)->default(0);

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'expired',
                'cancelled',
            ])->default('pending');

            $table->string('transaction_id', 100)->nullable();
            $table->text('snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
