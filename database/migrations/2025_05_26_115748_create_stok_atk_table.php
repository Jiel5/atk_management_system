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
        Schema::create('stok_atk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('atk_id')->index('stok_atk_atk_id_foreign');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_id')->index('stok_atk_satuan_id_foreign');
            $table->decimal('harga_per_unit', 12);
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_atk');
    }
};
