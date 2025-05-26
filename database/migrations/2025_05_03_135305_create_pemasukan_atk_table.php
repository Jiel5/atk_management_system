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
            $table->id();
            $table->foreignId('atk_id')->constrained('atk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->foreignId('satuan_id')->constrained('satuan')->onDelete('cascade');
            $table->decimal('total_biaya', 15, 2);
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
