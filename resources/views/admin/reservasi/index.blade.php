@extends('layouts.admin')

@section('title', 'Kelola Reservasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Reservasi</h5>
    </div>
    <div class="card-body">
        @if($reservasis->isEmpty())
            <div class="alert alert-info">
                Belum ada data reservasi.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Nama Tamu</th>
                        <th>Kamar</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasis as $index => $item)
                    <tr>
                        <td>{{ $index + 1 + (($reservasis->currentPage() - 1) * $reservasis->perPage()) }}</td>
                        <td>{{ $item->kode_booking }}</td>
                        <td>{{ $item->nama_tamu }}</td>
                        <td>{{ $item->kamar->nomor_kamar ?? '-' }} ({!! $item->kamar->typeKamar->nama_type ?? '-' !!})</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_check_in)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_check_out)) }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
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
                            <a href="{{ route('admin.reservasi.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $reservasis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection