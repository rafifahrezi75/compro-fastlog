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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karir_id')->nullable()->constrained('karirs')->nullOnDelete();
            $table->string('posisi');
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('file_cv');
            $table->text('pesan')->nullable();
            $table->string('status')->default('Pending'); // Pending, Review, Wawancara, Diterima, Ditolak
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
