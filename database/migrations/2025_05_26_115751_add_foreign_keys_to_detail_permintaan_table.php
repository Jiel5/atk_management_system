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
        Schema::table('detail_permintaan', function (Blueprint $table) {
            $table->foreign(['atk_id'])->references(['id'])->on('atk')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['permintaan_id'])->references(['id'])->on('permintaan_atk')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['satuan_id'])->references(['id'])->on('satuan')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_permintaan', function (Blueprint $table) {
            $table->dropForeign('detail_permintaan_atk_id_foreign');
            $table->dropForeign('detail_permintaan_permintaan_id_foreign');
            $table->dropForeign('detail_permintaan_satuan_id_foreign');
        });
    }
};
