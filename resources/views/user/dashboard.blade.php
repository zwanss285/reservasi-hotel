@extends('layouts.user')

@section('title', 'Dashboard Customer')

@section('content')
<!-- Hero Section-->
<div class="row mb-5">
    <div class="col-12">
        <div class="position-relative rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);">
            <div class="row g-0">
                <!-- Foto Kiri -->
                <div class="col-md-6">
                    <img src="{{ asset('img/reservasi.png') }}" alt="Hotel Reception" 
                         class="img-fluid w-100 h-100" style="object-fit: cover; height: 400px;">
                </div>
                <!-- Teks Kanan -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="text-white p-5 text-center text-md-start">
                        <h1 class="display-4 fw-bold mb-3">Welcome to our hotel</h1>
                        <p class="lead mb-4">Make a reservation and discover something extraordinary</p>
                        <a href="{{ route('user.reservasi.index') }}" class="btn btn-gold btn-lg px-4 py-2 fw-bold">
                            <i class="fas fa-calendar-check me-2"></i> My Reservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- OUR FACILITIES Section -->
<div class="row mb-5">
    <div class="col-12">
        <h2 class="text-center mb-4 fw-bold" style="color: #1a2a4f;">OUR FACILITIES</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ asset('img/swimmingpool.jpg') }}" class="img-fluid h-100 w-100" style="object-fit: cover; height: 100%;" alt="Swimming Pool">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="card-title fw-bold" style="color: #1a2a4f;">Swimming Pool</h3>
                                <div class="text-warning mb-2">★★★★★</div>
                                <p class="card-text text-muted">Rasakan pengalaman berenang menyegarkan di kolam renang indoor dengan pemandangan indah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ asset('img/gym.jpg') }}" class="img-fluid h-100 w-100" style="object-fit: cover; height: 100%;" alt="Fitness Center">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="card-title fw-bold" style="color: #1a2a4f;">Fitness Center / Gym</h3>
                                <div class="text-warning mb-2">★★★★★</div>
                                <p class="card-text text-muted">Rasakan pengalaman berolahraga dengan standar terbaik dan alat modern.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- OUR SERVICE Section -->
<div class="row mb-5">
    <div class="col-12">
        <h2 class="text-center mb-4 fw-bold" style="color: #1a2a4f;">OUR SERVICE</h2>
        <div class="row g-4">
            @for($i = 1; $i <= 3; $i++)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center">
                    <img src="{{ asset('img/room.jpg') }}" class="card-img-top rounded-top-4" style="height: 200px; object-fit: cover;" alt="Service">
                    <div class="card-body">
                        <ul class="text-start mb-4">
                            <li>Akomodasi nyaman dan bersih</li>
                            <li>Restoran hotel dengan menu lengkap</li>
                            <li>Layanan tambahan 24 jam</li>
                        </ul>
                        <!-- PERBAIKAN: Tombol mengarah ke halaman kamar tersedia -->
                        <a href="#rooms" class="btn btn-gold w-100 py-2 fw-bold rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i> BOOK NOW
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

<!-- KAMAR TERSEDIA Section -->
<div id="rooms" class="row mb-5">
    <div class="col-12">
        <h2 class="text-center mb-4 fw-bold" style="color: #1a2a4f;">Kamar Tersedia</h2>
        <div class="row g-4">
            @forelse($kamars as $kamar)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="text-white text-center p-4" style="background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);">
                        <i class="fas fa-bed fa-3x"></i>
                        <h5 class="mt-2 mb-0">{{ $kamar->typeKamar->nama_type }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <i class="fas fa-door-open me-1"></i> Kamar No: {{ $kamar->nomor_kamar }}
                        </p>
                        <p class="text-muted mb-2">
                            <i class="fas fa-users me-1"></i> Kapasitas: {{ $kamar->typeKamar->kapasitas_maksimal }} orang
                        </p>
                        <p class="text-muted mb-3">
                            <i class="fas fa-utensils me-1"></i> Fasilitas: {{ Str::limit($kamar->typeKamar->fasilitas, 40) }}
                        </p>
                        <h4 class="text-gold fw-bold mb-0">
                            Rp {{ number_format($kamar->typeKamar->harga_per_malam, 0, ',', '.') }}
                            <small class="text-muted fs-6">/malam</small>
                        </h4>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                        <!-- PERBAIKAN: Tombol mengarah ke route reservasi.create -->
                        <a href="{{ route('user.reservasi.create', $kamar->id) }}" class="btn btn-gold w-100 py-2 fw-bold rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-info-circle me-2"></i> Belum ada kamar yang tersedia. Silakan cek kembali nanti.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Informasi Contact Kami Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);">
            <div class="card-body p-5 text-center text-white">
                <h2 class="mb-4 fw-bold">Informasi Contact Kami</h2>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <a href="#" class="text-white mx-3 fs-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="text-white mx-3 fs-1">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="text-white mx-3 fs-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="text-white mx-3 fs-1">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Staff On Duty Section -->
<div class="row">
    <div class="col-12">
        <h2 class="text-center mb-4 fw-bold" style="color: #1a2a4f;">Staff On Duty</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="Staff">
                        <p class="fw-bold mb-0">@zwanss.id</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="Staff">
                        <p class="fw-bold mb-0">@lipprtmaa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="Staff">
                        <p class="fw-bold mb-0">@geraldmarentek</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="Staff">
                        <p class="fw-bold mb-0">@fiviiee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="Staff">
                        <p class="fw-bold mb-0">@ryanriski</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection