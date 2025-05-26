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
        Schema::table('atk', function (Blueprint $table) {
            $table->foreign(['kategori_id'])->references(['id'])->on('kategori')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atk', function (Blueprint $table) {
            $table->dropForeign('atk_kategori_id_foreign');
        });
    }
};
