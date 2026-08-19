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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo');
            $table->string('kota');
            $table->string('alamatLengkap');
            $table->string('email');
            $table->text('notelp');
            $table->text('linkFacebook');
            $table->text('linkInstagram');
            $table->text('linkX');
            $table->text('linkLinkedin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
