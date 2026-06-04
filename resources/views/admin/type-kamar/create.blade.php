@extends('layouts.admin')

@section('title', 'Tambah Tipe Kamar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Tipe Kamar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.type-kamar.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama_type" class="form-label">Nama Tipe Kamar <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_type') is-invalid @enderror" 
                       id="nama_type" name="nama_type" value="{{ old('nama_type') }}" required>
                @error('nama_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="fasilitas" class="form-label">Fasilitas <span class="text-danger">*</span></label>
                <textarea class="form-control @error('fasilitas') is-invalid @enderror" 
                          id="fasilitas" name="fasilitas" rows="3" required>{{ old('fasilitas') }}</textarea>
                <small class="text-muted">Contoh: AC, TV, Wifi, Kamar Mandi Dalam, Breakfast</small>
                @error('fasilitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="harga_per_malam" class="form-label">Harga per Malam <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror" 
                               id="harga_per_malam" name="harga_per_malam" value="{{ old('harga_per_malam') }}" required>
                        @error('harga_per_malam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kapasitas_maksimal" class="form-label">Kapasitas Maksimal (Orang) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('kapasitas_maksimal') is-invalid @enderror" 
                               id="kapasitas_maksimal" name="kapasitas_maksimal" value="{{ old('kapasitas_maksimal') }}" required>
                        @error('kapasitas_maksimal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.type-kamar.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection