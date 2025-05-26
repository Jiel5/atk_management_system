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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip', 50)->nullable();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('no_hp', 20)->nullable();
            $table->string('password');
            $table->enum('jabatan', ['Panitera Pengadilan Negeri Kudus', 'Panitera Muda Hukum Pengadilan Negeri Kudus', 'Panitera Muda Perdata Pengadilan Negeri Kudus', 'Panitera Muda Pidana Pengadilan Negeri Kudus', 'Panitera Pengganti Pengadilan Negeri Kudus', 'Juru Sita Pengadilan Negeri Kudus', 'Klerek – Analis Perkara Peradilan, Panitera Muda Perdata', 'Klerek – Pengelola Penanganan Perkara, Panitera Muda Pidana', 'Klerek – Analis Perkara Peradilan, Panitera Muda Pidana', 'Ketua Pengadilan Negeri Kudus', 'Hakim Pengadilan Negeri Kudus', 'Sekretaris Pengadilan Negeri Kudus', 'Kepala Sub Bagian Perencanaan, Teknologi Informasi, dan Pelaporan', 'Kepala Sub Bagian Umum dan Keuangan Pengadilan Negeri Kudus', 'Kepala Sub Bagian Kepegawaian, Organisasi, dan Tata Laksana', 'Klerek – Pengolah Data dan Informasi, Sub Bagian Kepegawaian', 'Klerek – Pengadministrasi Perkantoran, Sub Bagian Umum dan Keuangan', 'Klerek – Penelaah Teknis Kebijakan, Sub Bagian Perencanaan', 'Klerek – Pengolah Data dan Informasi, Sub Bagian Umum dan Keuangan', 'Klerek – Analis Perkara Peradilan', 'Honorer / Satpam', 'Honorer / Sopir', 'Honorer / Pramubakti']);
            $table->enum('role', ['bendahara', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
