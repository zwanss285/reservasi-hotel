<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            position: fixed;
            width: 250px;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 12px 20px;
            transition: 0.3s;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.3);
            border-left: 4px solid #ffd700;
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }
        
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .navbar-top {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center py-4">
            <h4 class="text-white">Hotel Admin</h4>
            <small class="text-white-50">{{ Auth::user()->name }}</small>
        </div>
        <hr class="bg-white">
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.type-kamar.*') ? 'active' : '' }}" href="{{ route('admin.type-kamar.index') }}">
                <i class="fas fa-bed"></i> Tipe Kamar
            </a>
            <a class="nav-link {{ request()->routeIs('admin.kamar.*') ? 'active' : '' }}" href="{{ route('admin.kamar.index') }}">
                <i class="fas fa-door-open"></i> Kelola Kamar
            </a>
            <a class="nav-link {{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}" href="{{ route('admin.reservasi.index') }}">
                <i class="fas fa-calendar-check"></i> Reservasi
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}">
                <i class="fas fa-credit-card"></i> Pembayaran
            </a>
            {{-- <a class="nav-link {{ request()->routeIs('admin.maintenance.*') ? 'active' : '' }}" href="{{ route('admin.maintenance.index') }}">
                <i class="fas fa-tools"></i> Maintenance
            </a>
            <a class="nav-link {{ request()->routeIs('admin.review.*') ? 'active' : '' }}" href="{{ route('admin.review.index') }}">
                <i class="fas fa-star"></i> Review
            </a> --}}
        </nav>
        <hr class="bg-white">
        <div class="position-absolute bottom-0 w-100 p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="navbar-top d-flex justify-content-between align-items-center">
            <h5 class="mb-0">@yield('title')</h5>
            <div>
                <i class="fas fa-user-circle fa-2x text-secondary"></i>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>