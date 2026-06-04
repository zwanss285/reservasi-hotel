<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TypeKamar;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil kamar tersedia
        $kamars = Kamar::with('typeKamar')
            ->where('status', 'tersedia')
            ->latest()
            ->take(6)
            ->get();
        
        $typeKamars = TypeKamar::all();
        
        // Data facilities
        $facilities = [
            (object) ['name' => 'Swimming Pool', 'icon' => 'fas fa-swimmer', 'description' => 'Kolam renang outdoor dengan pemandangan indah'],
            (object) ['name' => 'Fitness Center', 'icon' => 'fas fa-dumbbell', 'description' => 'Pusat kebugaran dengan alat modern'],
            (object) ['name' => 'Restaurant', 'icon' => 'fas fa-utensils', 'description' => 'Restoran dengan berbagai pilihan menu'],
            (object) ['name' => 'Free WiFi', 'icon' => 'fas fa-wifi', 'description' => 'Akses internet cepat di seluruh area'],
            (object) ['name' => 'Parking Area', 'icon' => 'fas fa-parking', 'description' => 'Area parkir luas dan aman'],
            (object) ['name' => 'Spa', 'icon' => 'fas fa-spa', 'description' => 'Layanan spa dan pijat profesional'],
        ];
        
        // ✅ BUAT VARIABEL $testimonials KOSONG (karena tabel reviews belum siap)
        $testimonials = collect(); // collection kosong
        
        return view('home', compact('kamars', 'typeKamars', 'facilities', 'testimonials'));
    }
    
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $kamars = Kamar::with('typeKamar')
            ->where('status', 'tersedia')
            ->whereHas('typeKamar', function($q) use ($search) {
                $q->where('nama_type', 'like', "%{$search}%")
                  ->orWhere('fasilitas', 'like', "%{$search}%");
            })
            ->get();
        
        $typeKamars = TypeKamar::all();
        
        $facilities = [
            (object) ['name' => 'Swimming Pool', 'icon' => 'fas fa-swimmer', 'description' => 'Kolam renang outdoor dengan pemandangan indah'],
            (object) ['name' => 'Fitness Center', 'icon' => 'fas fa-dumbbell', 'description' => 'Pusat kebugaran dengan alat modern'],
            (object) ['name' => 'Restaurant', 'icon' => 'fas fa-utensils', 'description' => 'Restoran dengan berbagai pilihan menu'],
            (object) ['name' => 'Free WiFi', 'icon' => 'fas fa-wifi', 'description' => 'Akses internet cepat di seluruh area'],
            (object) ['name' => 'Parking Area', 'icon' => 'fas fa-parking', 'description' => 'Area parkir luas dan aman'],
            (object) ['name' => 'Spa', 'icon' => 'fas fa-spa', 'description' => 'Layanan spa dan pijat profesional'],
        ];
        
        // ✅ BUAT VARIABEL $testimonials KOSONG
        $testimonials = collect();
        
        return view('home', compact('kamars', 'typeKamars', 'facilities', 'testimonials'));
    }
}