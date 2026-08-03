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
        Schema::create('karirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karir');
            $table->string('slug')->unique();
            $table->string('kota');
            $table->string('provinsi');
            $table->string('negara')->default('Indonesia');
            $table->text('alamat_detail');
            $table->string('tipe_pekerjaan')->default('Full-Time');
            $table->string('departemen')->nullable()->default('Operations');
            $table->longText('deskripsi')->nullable();
            $table->longText('kualifikasi')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karirs');
    }
};
