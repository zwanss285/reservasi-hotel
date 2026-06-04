@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white" style="background: linear-gradient(135deg, #1a2a4f 0%, #2a3d6e 100%);">
                <div class="card-body">
                    <h3 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mb-0">Berikut ringkasan data Hotel Anda hari ini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Kamar</h6>
                            <h2 class="mb-0">{{ $totalKamar }}</h2>
                        </div>
                        <i class="fas fa-bed fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Kamar Tersedia</h6>
                            <h2 class="mb-0">{{ $totalKamarTersedia }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Kamar Terisi</h6>
                            <h2 class="mb-0">{{ $totalKamarTerisi }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Maintenance</h6>
                            <h2 class="mb-0">{{ $totalKamarMaintenance }}</h2>
                        </div>
                        <i class="fas fa-tools fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Reservasi</h6>
                            <h2 class="mb-0">{{ $totalReservasi }}</h2>
                        </div>
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Customer</h6>
                            <h2 class="mb-0">{{ $totalCustomer }}</h2>
                        </div>
                        <i class="fas fa-user-friends fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Pendapatan</h6>
                            <h2 class="mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Status Reservasi Cards -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Reservasi</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-2 col-6 mb-2">
                            <div class="bg-warning p-3 rounded">
                                <h6>Pending</h6>
                                <h3>{{ $totalReservasiPending }}</h3>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-2">
                            <div class="bg-info p-3 rounded text-white">
                                <h6>Confirmed</h6>
                                <h3>{{ $totalReservasiConfirmed }}</h3>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-2">
                            <div class="bg-primary p-3 rounded text-white">
                                <h6>Check In</h6>
                                <h3>{{ $totalReservasiCheckIn }}</h3>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-2">
                            <div class="bg-success p-3 rounded text-white">
                                <h6>Check Out</h6>
                                <h3>{{ $totalReservasiCheckOut }}</h3>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-2">
                            <div class="bg-danger p-3 rounded text-white">
                                <h6>Cancelled</h6>
                                <h3>{{ $totalReservasiCancelled }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservasi Terbaru -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Reservasi Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Nama Tamu</th>
                                    <th>Kamar</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservasiTerbaru as $item)
                                <tr>
                                    <td>{{ $item->kode_booking }}</td>
                                    <td>{{ $item->nama_tamu }}</td>
                                    <td>{{ $item->kamar->nomor_kamar ?? '-' }}</td>
                                    <td>{{ $item->tanggal_check_in }}</td>
                                    <td>{{ $item->tanggal_check_out }}</td>
                                    <td>
                                        @php
                                            $statusColor = [
                                                'pending' => 'warning',
                                                'confirmed' => 'info',
                                                'checked_in' => 'primary',
                                                'checked_out' => 'success',
                                                'cancelled' => 'danger'
                                            ][$item->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.reservasi.show', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari controller
    const reservasiData = @json(array_values($chartReservasiData));
    const pendapatanData = @json(array_values($chartPendapatanData));
    const bulanLabels = @json($bulanLabels);
    
    // Grafik Reservasi (Line Chart)
    const reservasiCtx = document.getElementById('reservasiChart').getContext('2d');
    new Chart(reservasiCtx, {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Jumlah Reservasi',
                data: reservasiData,
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffc107',
                pointBorderColor: '#fff',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Reservasi: ' + context.raw + ' booking';
                        }
                    }
                }
            }
        }
    });
    
    // Grafik Pendapatan (Bar Chart)
    const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
    new Chart(pendapatanCtx, {
        type: 'bar',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: pendapatanData,
                backgroundColor: 'rgba(40, 167, 69, 0.8)',
                borderColor: '#28a745',
                borderWidth: 1,
                borderRadius: 5,
                barPercentage: 0.7,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endsection