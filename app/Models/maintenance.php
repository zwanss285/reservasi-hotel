<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kamar;

class maintenance extends Model
{
    protected $fillable = [
        'kamar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
