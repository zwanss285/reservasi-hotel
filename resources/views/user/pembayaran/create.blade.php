@extends('layouts.user')

@section('title', 'Pembayaran Reservasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Pembayaran Reservasi</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>ID Pemesanan:</strong> {{ $reservasi->kode_booking }}
                        </div>
                        <div class="col-md-6">
                            <strong>Total Pembayaran:</strong> Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5>Instruksi Pembayaran</h5>
                        <p>Silahkan transfer ke salah satu rekening berikut:</p>
                        <ul>
                            <li>BCA : 1234567890 (Hotel Conview)</li>
                            <li>BRI : 0987654321 (Hotel Conview)</li>
                        </ul>
                        <p>Setelah transfer, upload bukti dibawah ini.</p>
                    </div>
                    
                    <form action="{{ route('user.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">
                        
                        <div class="mb-3">
                            <label>Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100">Kirim Bukti Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection