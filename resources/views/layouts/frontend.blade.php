<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel Booking - @yield('title', 'Home')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: 0.3s;
            font-weight: 500;
        }
        
        .navbar-custom .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: #ffd700;
            color: #1a1a2e !important;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .btn-login:hover {
            background: #ffed4a;
            transform: translateY(-2px);
        }
        
        .btn-register {
            background: transparent;
            border: 2px solid #ffd700;
            color: #ffd700 !important;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .btn-register:hover {
            background: #ffd700;
            color: #1a1a2e !important;
        }
        
        /* Hero Section */
        .hero-section {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        
        .hero-section h1 {
            font-size: 52px;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .hero-section p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        
        .btn-hero {
            background: #ffd700;
            color: #1a1a2e;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        
        .btn-hero:hover {
            background: #ffed4a;
            transform: translateY(-3px);
        }
        
        /* Section Title */
        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            font-weight: 700;
            position: relative;
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #ffd700;
            margin: 15px auto 0;
        }
        
        /* Facilities */
        .facilities-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .facility-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .facility-card i {
            color: #ffd700;
            margin-bottom: 20px;
        }
        
        .facility-card h3 {
            margin-bottom: 15px;
            font-size: 22px;
        }
        
        /* Rooms */
        .rooms-section {
            padding: 80px 0;
        }
        
        .room-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .room-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .room-info {
            padding: 20px;
        }
        
        .room-price {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        
        .btn-book {
            display: block;
            text-align: center;
            background: #1a1a2e;
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 15px;
            transition: 0.3s;
            font-weight: 600;
        }
        
        .btn-book:hover {
            background: #667eea;
            color: white;
        }
        
        /* Contact */
        .contact-section {
            padding: 60px 0;
            background: #1a1a2e;
            color: white;
        }
        
        .contact-item {
            text-align: center;
        }
        
        .contact-item i {
            font-size: 32px;
            margin-bottom: 15px;
            color: #ffd700;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 25px 0;
            text-align: center;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 32px;
            }
            
            .section-title {
                font-size: 28px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-hotel me-2"></i> Hotel Booking
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities">
                            <i class="fas fa-swimmer me-1"></i> Facilities
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rooms">
                            <i class="fas fa-bed me-1"></i> Rooms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>
                </ul>
                <div class="ms-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn-login">Login</a>
                        <a href="{{ route('register') }}" class="btn-register">Register</a>
                    @else
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn-login">Admin Panel</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn-login">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-register" style="background: transparent;">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Hotel Booking. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>