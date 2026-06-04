<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model  // ← Huruf besar P
{
    use HasFactory;

    protected $table = 'pembayarans';  // ← Tambahkan ini untuk memastikan nama tabel
    
    protected $fillable = [
        'reservasi_id',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'status'
    ];
    
    // Relasi ke Reservasi (WAJIB)
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id');
    }
    
    // Relasi ke User melalui reservasi (Opsional, untuk kemudahan)
    public function user()
    {
        return $this->hasOneThrough(User::class, Reservasi::class, 'id', 'id', 'reservasi_id', 'user_id');
    }
    
    // Relasi ke Kamar melalui reservasi (Opsional)
    public function kamar()
    {
        return $this->hasOneThrough(Kamar::class, Reservasi::class, 'id', 'id', 'reservasi_id', 'kamar_id');
    }
}