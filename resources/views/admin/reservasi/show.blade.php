@extends('layouts.admin')

@section('title', 'Detail Reservasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Reservasi - {{ $reservasi->kode_booking }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Kode Booking</th>
                        <td>: {{ $reservasi->kode_booking }}</td>
                    </tr>
                    <tr>
                        <th>Nama Tamu</th>
                        <td>: {{ $reservasi->nama_tamu }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>: {{ $reservasi->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $reservasi->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tamu</th>
                        <td>: {{ $reservasi->jumlah_tamu }} orang</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Kamar</th>
                        <td>: {{ $reservasi->kamar->nomor_kamar ?? '-' }} ({{ $reservasi->kamar->typeKamar->nama_type ?? '-' }})</td>
                    </tr>
                    <tr>
                        <th>Check In</th>
                        <td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_in)) }}</td>
                    </tr>
                    <tr>
                        <th>Check Out</th>
                        <td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_out)) }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>: Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @php
                                $statusColor = [
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'checked_in' => 'primary',
                                    'checked_out' => 'success',
                                    'cancelled' => 'danger'
                                ][$reservasi->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">{{ ucfirst($reservasi->status) }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        @if($reservasi->catatan)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <strong>Catatan:</strong> {{ $reservasi->catatan }}
                </div>
            </div>
        </div>
        @endif
        
        <div class="row mt-3">
            <div class="col-12">
                <h6>Update Status Reservasi</h6>
                <form action="{{ route('admin.reservasi.update-status', $reservasi->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select d-inline w-auto">
                        <option value="pending" {{ $reservasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $reservasi->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="checked_in" {{ $reservasi->status == 'checked_in' ? 'selected' : '' }}>Check In</option>
                        <option value="checked_out" {{ $reservasi->status == 'checked_out' ? 'selected' : '' }}>Check Out</option>
                        <option value="cancelled" {{ $reservasi->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                </form>
                
                @if($reservasi->status == 'pending')
                <form action="{{ route('admin.reservasi.verify-payment', $reservasi->id) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Verifikasi Pembayaran</button>
                </form>
                @endif
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection