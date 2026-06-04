<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasi_id')->constrained('reservasis')->onDelete('cascade');  // ← perbaiki nama!
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'kartu_kredit'])->default('transfer');
            $table->integer('jumlah_pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->enum('status', ['belum_bayar', 'menunggu_verifikasi', 'lunas', 'refund'])->default('belum_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};