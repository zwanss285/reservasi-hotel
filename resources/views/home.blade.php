@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div>
        <h1>Welcome to Hotel Booking</h1>
        <p>Make a reservation and discover something extraordinary</p>
        @guest
            <a href="{{ route('login') }}" class="btn-hero">Book Now</a>
        @else
            <a href="{{ route('user.dashboard') }}" class="btn-hero">Book Now</a>
        @endguest
    </div>
</section>

<!-- ========== TAMBAHKAN SECTION ABOUT HOTEL ========== -->
<section id="about" class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="about-image">
                    <img src="{{ asset('img/building.png') }}" alt="Hotel Building" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-content">
                    <h2 class="section-title text-start">About Our Hotel</h2>
                    <p class="lead">Experience luxury and comfort at its finest</p>
                    <p>Hotel Conview adalah hotel bintang 4 yang terletak di pinggir pantai Bali. Kami menyediakan layanan terbaik dengan fasilitas modern dan staf profesional yang siap melayani Anda 24 jam.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="about-stats">
                                <i class="fas fa-calendar-check fa-2x text-gold"></i>
                                <h3>500+</h3>
                                <p>Happy Customers</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about-stats">
                                <i class="fas fa-bed fa-2x text-gold"></i>
                                <h3>10+</h3>
                                <p>Rooms</p>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="about-stats">
                                <i class="fas fa-star fa-2x text-gold"></i>
                                <h3>4.8</h3>
                                <p>Customer Rating</p>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="about-stats">
                                <i class="fas fa-clock fa-2x text-gold"></i>
                                <h3>24/7</h3>
                                <p>Service Support</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn-gold-about mt-4" onclick="location.href='#rooms'">
                        Explore Rooms <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section id="facilities" class="facilities-section">
    <div class="container">
        <h2 class="section-title">OUR FACILITIES</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-swimmer fa-3x"></i>
                    <h3>Swimming Pool</h3>
                    <p>Kolam renang outdoor dengan pemandangan indah</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-dumbbell fa-3x"></i>
                    <h3>Fitness Center</h3>
                    <p>Pusat kebugaran dengan alat modern</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-utensils fa-3x"></i>
                    <h3>Restaurant</h3>
                    <p>Restoran dengan berbagai pilihan menu</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-wifi fa-3x"></i>
                    <h3>Free WiFi</h3>
                    <p>Akses internet cepat di seluruh area</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-parking fa-3x"></i>
                    <h3>Parking Area</h3>
                    <p>Area parkir luas dan aman</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="facility-card">
                    <i class="fas fa-spa fa-3x"></i>
                    <h3>Spa</h3>
                    <p>Layanan spa dan pijat profesional</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms" class="rooms-section">
    <div class="container">
        <h2 class="section-title">AVAILABLE ROOMS</h2>
        <div class="row">
            @forelse($kamars as $kamar)
            <div class="col-md-4 mb-4">
                <div class="room-card">
                    <div class="room-image">
                        <i class="fas fa-bed fa-3x"></i>
                    </div>
                    <div class="room-info">
                        <h3>{{ $kamar->typeKamar->nama_type }}</h3>
                        <p>Room No: {{ $kamar->nomor_kamar }}</p>
                        <p class="room-price">Rp {{ number_format($kamar->typeKamar->harga_per_malam, 0, ',', '.') }} <span style="font-size: 14px;">/night</span></p>
                        <p>Capacity: {{ $kamar->typeKamar->kapasitas_maksimal }} persons</p>
                        @guest
                            <a href="{{ route('login') }}" class="btn-book">Login to Book</a>
                        @else
                            <a href="{{ route('user.reservasi.create', $kamar->id) }}" class="btn-book">Book Now</a>
                        @endguest
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No rooms available at the moment.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title" style="color: white;">CONTACT US</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <p class="mb-0">+62 123 4567 890</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <p class="mb-0">info@hotelbooking.com</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p class="mb-0">Jl. Hotel No. 123, Jakarta</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection