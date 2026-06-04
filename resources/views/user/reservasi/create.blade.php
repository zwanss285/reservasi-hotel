@extends('layouts.frontend')

@section('title', 'Form Reservasi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Reservasi Kamar</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Detail Kamar:</strong><br>
                        Tipe Kamar: {{ $kamar->typeKamar->nama_type }}<br>
                        Nomor Kamar: {{ $kamar->nomor_kamar }}<br>
                        Harga: Rp {{ number_format($kamar->typeKamar->harga_per_malam, 0, ',', '.') }}/malam<br>
                        Kapasitas: {{ $kamar->typeKamar->kapasitas_maksimal }} orang
                    </div>
                    
                    <form action="{{ route('user.reservasi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                        
                        <div class="mb-3">
                            <label for="nama_tamu" class="form-label">Nama Tamu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_tamu') is-invalid @enderror" 
                                   id="nama_tamu" name="nama_tamu" value="{{ old('nama_tamu', Auth::user()->name) }}" required>
                            @error('nama_tamu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                   id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_check_in" class="form-label">Check In <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_check_in') is-invalid @enderror" 
                                           id="tanggal_check_in" name="tanggal_check_in" value="{{ old('tanggal_check_in') }}" required>
                                    @error('tanggal_check_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_check_out" class="form-label">Check Out <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_check_out') is-invalid @enderror" 
                                           id="tanggal_check_out" name="tanggal_check_out" value="{{ old('tanggal_check_out') }}" required>
                                    @error('tanggal_check_out')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jumlah_tamu" class="form-label">Jumlah Tamu <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah_tamu') is-invalid @enderror" 
                                   id="jumlah_tamu" name="jumlah_tamu" value="{{ old('jumlah_tamu', 1) }}" min="1" max="{{ $kamar->typeKamar->kapasitas_maksimal }}" required>
                            @error('jumlah_tamu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection