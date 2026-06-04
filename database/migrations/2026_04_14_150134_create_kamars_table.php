<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_kamar_id')->constrained('type_kamars')->onDelete('cascade');
            $table->string('nomor_kamar')->unique();  // Tambah nomor kamar!
            $table->integer('lantai')->default(1);
            $table->enum('status', ['tersedia', 'terisi', 'maintenance', 'dibersihkan'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};