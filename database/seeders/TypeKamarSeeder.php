<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeKamarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_kamars')->insert([
            [
                'nama_type' => 'Standard',
                'deskripsi' => 'Kamar nyaman dengan fasilitas standar',
                'fasilitas' => 'AC, TV, Kamar Mandi Dalam, Wifi',
                'harga_per_malam' => 300000,
                'kapasitas_maksimal' => 2,
            ],
            [
                'nama_type' => 'Deluxe',
                'deskripsi' => 'Kamar luas dengan pemandangan kota',
                'fasilitas' => 'AC, TV, Kamar Mandi Dalam, Wifi, Breakfast, Mini Bar',
                'harga_per_malam' => 500000,
                'kapasitas_maksimal' => 2,
            ],
            [
                'nama_type' => 'Suite',
                'deskripsi' => 'Kamar mewah dengan ruang tamu terpisah',
                'fasilitas' => 'AC, TV, Kamar Mandi Dalam, Wifi, Breakfast, Kolam Renang, Gym',
                'harga_per_malam' => 1000000,
                'kapasitas_maksimal' => 4,
            ],
        ]);
    }
}