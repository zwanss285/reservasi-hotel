<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('type_kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_type');           // Standard, Deluxe, Suite
            $table->text('deskripsi')->nullable();
            $table->text('fasilitas');              // Sarapan, Wifi, Pool, dll
            $table->integer('harga_per_malam');
            $table->integer('kapasitas_maksimal');  // Maksimal tamu
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_kamars');
    }
};