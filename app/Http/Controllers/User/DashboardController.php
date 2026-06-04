<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\TypeKamar;

class DashboardController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with('typeKamar')
            ->where('status', 'tersedia')
            ->get();
        
        // Ambil tipe kamar untuk filter
        $typeKamars = TypeKamar::all();
        
        return view('user.dashboard', compact('kamars', 'typeKamars'));
    }
}