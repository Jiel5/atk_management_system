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
        Schema::table('stok_atk', function (Blueprint $table) {
            $table->foreign(['atk_id'])->references(['id'])->on('atk')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['satuan_id'])->references(['id'])->on('satuan')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_atk', function (Blueprint $table) {
            $table->dropForeign('stok_atk_atk_id_foreign');
            $table->dropForeign('stok_atk_satuan_id_foreign');
        });
    }
};
