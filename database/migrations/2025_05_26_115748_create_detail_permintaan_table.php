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
        Schema::create('detail_permintaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permintaan_id')->index('detail_permintaan_permintaan_id_foreign');
            $table->unsignedBigInteger('atk_id')->index('detail_permintaan_atk_id_foreign');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_id')->index('detail_permintaan_satuan_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_permintaan');
    }
};
