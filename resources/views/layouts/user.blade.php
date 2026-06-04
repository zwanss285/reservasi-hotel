<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel Booking - @yield('title', 'Dashboard')</title>
    
    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Navbar dengan Backdrop Blur */
        .navbar-user {
            background: rgba(26, 42, 79, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-user .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-user .navbar-brand i {
            color: #c9a03d;
        }
        
        .navbar-user .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: 0.3s;
            margin: 0 5px;
        }
        
        .navbar-user .nav-link:hover {
            color: #c9a03d !important;
            transform: translateY(-2px);
        }
        
        .navbar-user .dropdown-toggle {
            color: white !important;
        }
        
        .navbar-user .dropdown-menu {
            background: rgba(26, 42, 79, 0.95);
            backdrop-filter: blur(12px);
            border: none;
            border-radius: 12px;
            margin-top: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .navbar-user .dropdown-item {
            color: white;
            transition: 0.3s;
            border-radius: 8px;
        }
        
        .navbar-user .dropdown-item:hover {
            background: #c9a03d;
            color: #1a2a4f;
        }
        
        /* Navbar dengan Gradient (Alternatif) */
        /* Ganti class navbar-user dengan ini jika ingin pakai gradient */
        /*
        .navbar-user {
            background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 12px 0;
        }
        */
        
        /* Footer */
        .footer-user {
            background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);
            color: white;
            padding: 25px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        /* Alert */
        .alert-custom {
            border-radius: 12px;
            border: none;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar with Backdrop Blur -->
    <nav class="navbar navbar-expand-lg navbar-user sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                <i class="fas fa-hotel me-2"></i> Hotel Booking
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.reservasi.*') ? 'active' : '' }}" href="{{ route('user.reservasi.index') }}">
                            <i class="fas fa-calendar-check me-1"></i> Reservasi Saya
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-user">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Hotel Conview. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>