<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeKamar;
use Illuminate\Http\Request;

class TypeKamarController extends Controller
{
    public function index()
    {
        $typeKamars = TypeKamar::latest()->get();
        return view('admin.type-kamar.index', compact('typeKamars'));
    }

    public function create()
    {
        return view('admin.type-kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_type' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'required|string',
            'harga_per_malam' => 'required|integer|min:0',
            'kapasitas_maksimal' => 'required|integer|min:1',
        ]);

        TypeKamar::create($request->all());

        return redirect()->route('admin.type-kamar.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        return view('admin.type-kamar.edit', compact('typeKamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_type' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'required|string',
            'harga_per_malam' => 'required|integer|min:0',
            'kapasitas_maksimal' => 'required|integer|min:1',
        ]);

        $typeKamar = TypeKamar::findOrFail($id);
        $typeKamar->update($request->all());

        return redirect()->route('admin.type-kamar.index')
            ->with('success', 'Tipe kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        
        if ($typeKamar->kamars()->count() > 0) {
            return redirect()->route('admin.type-kamar.index')
                ->with('error', 'Tipe kamar tidak bisa dihapus karena masih memiliki kamar');
        }
        
        $typeKamar->delete();
        
        return redirect()->route('admin.type-kamar.index')
            ->with('success', 'Tipe kamar berhasil dihapus');
    }
}