<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kamar; 

class typekamar extends Model
{
    protected $fillable = [
        'nama_type',
        'deskripsi',
        'fasilitas',
        'harga_per_malam',
        'kapasitas_maksimal',
        'foto'
    ];

     public function kamars()
    {
        return $this->hasMany(Kamar::class, 'type_kamar_id');
    }
}
