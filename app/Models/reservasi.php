<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'kode_booking',
        'nama_tamu',
        'no_telepon',
        'email',
        'jumlah_tamu',
        'tanggal_check_in',
        'tanggal_check_out',
        'total_harga',
        'catatan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi ke TypeKamar (melalui kamar)
    public function typeKamar()
    {
        return $this->hasOneThrough(TypeKamar::class, Kamar::class, 'id', 'id', 'kamar_id', 'type_kamar_id');
    }

    // TAMBAHKAN RELASI PEMBAYARAN INI
    public function pembayaran()
    {
        // Jika satu reservasi memiliki satu pembayaran
        return $this->hasOne(Pembayaran::class);
        
        // Atau jika satu reservasi bisa memiliki banyak pembayaran
        // return $this->hasMany(Pembayaran::class);
    }
}