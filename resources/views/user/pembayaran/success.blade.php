@extends('layouts.user')

@section('title', 'Bukti Pembayaran Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    <h3 class="mt-3">Bukti Pembayaran Berhasil dikirim</h3>
                    <p class="mt-3">
                        Terima Kasih, Bukti Pembayaran untuk ID pemesanan: <strong>{{ $reservasi->kode_booking }}</strong>
                    </p>
                    <p>
                        Admin akan mengecek bukti pembayaran anda, Status akan berubah menjadi "Dikonfirmasi" jika sudah diverifikasi.
                    </p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection