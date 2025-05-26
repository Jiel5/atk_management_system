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
        Schema::create('pemasukan_atk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('atk_id')->index('pemasukan_atk_atk_id_foreign');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_id')->index('pemasukan_atk_satuan_id_foreign');
            $table->decimal('total_biaya', 15);
            $table->date('tanggal_masuk');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan_atk');
    }
};
