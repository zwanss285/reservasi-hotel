<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // ← perbaiki typo!
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade'); // ← ganti dari id_type_kamar
            $table->string('kode_booking')->unique();  // Tambah kode booking!
            $table->string('nama_tamu');               // ← WAJIB!
            $table->string('no_telepon');              // ← WAJIB!
            $table->string('email')->nullable();
            $table->integer('jumlah_tamu');
            $table->date('tanggal_check_in');
            $table->date('tanggal_check_out');
            $table->integer('total_harga');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};