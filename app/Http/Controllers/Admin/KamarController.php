<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\TypeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with('typeKamar')->latest()->get();
        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        $typeKamars = TypeKamar::all();
        return view('admin.kamar.create', compact('typeKamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_kamar_id' => 'required|exists:type_kamars,id',
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar',
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance,dibersihkan',
        ]);

        Kamar::create($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $typeKamars = TypeKamar::all();
        return view('admin.kamar.edit', compact('kamar', 'typeKamars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_kamar_id' => 'required|exists:type_kamars,id',
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar,' . $id,
            'lantai' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance,dibersihkan',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        
        // Cek apakah kamar pernah dipesan
        if ($kamar->reservasis()->count() > 0) {
            return redirect()->route('admin.kamar.index')
                ->with('error', 'Kamar tidak bisa dihapus karena sudah pernah dipesan');
        }
        
        $kamar->delete();
        
        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus');
    }
}