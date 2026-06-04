@extends('layouts.admin')

@section('title', 'Tambah Kamar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Kamar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kamar.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nomor_kamar') is-invalid @enderror" 
                       id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar') }}" required>
                <small class="text-muted">Contoh: 101, 102, 201</small>
                @error('nomor_kamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="type_kamar_id" class="form-label">Tipe Kamar <span class="text-danger">*</span></label>
                <select class="form-control @error('type_kamar_id') is-invalid @enderror" 
                        id="type_kamar_id" name="type_kamar_id" required>
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($typeKamars as $type)
                    <option value="{{ $type->id }}" {{ old('type_kamar_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->nama_type }} - Rp {{ number_format($type->harga_per_malam, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
                @error('type_kamar_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="lantai" class="form-label">Lantai <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('lantai') is-invalid @enderror" 
                       id="lantai" name="lantai" value="{{ old('lantai', 1) }}" required>
                @error('lantai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-control @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="dibersihkan" {{ old('status') == 'dibersihkan' ? 'selected' : '' }}>Dibersihkan</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection