<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'type_kamar_id',
        'status',
        'foto',
    ];

    public function typeKamar()
    {
        return $this->belongsTo(typekamar::class, 'type_kamar_id');
     }

     public function reviews()
    {
        return $this->hasMany(review::class);
    }

     public function maintenances()
    {
        return $this->hasMany(maintenance::class);
    }

     public function pembayarans()
    {
        return $this->hasMany(pembayaran::class);
    }
}