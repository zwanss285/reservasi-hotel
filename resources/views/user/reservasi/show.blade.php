@extends('layouts.frontend')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Reservasi - {{ $reservasi->kode_booking }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Kode Booking</th>
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
                                    <th>Kamar</th>
                                    <td>: {{ $reservasi->kamar->nomor_kamar ?? '-' }} ({{ $reservasi->kamar->typeKamar->nama_type ?? '-' }})</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Check In</th>
                                    <td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_in)) }}</td>
                                </tr>
                                <tr>
                                    <th>Check Out</th>
                                    <td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_out)) }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Tamu</th>
                                    <td>: {{ $reservasi->jumlah_tamu }} orang</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td>: Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($reservasi->catatan)
                    <div class="alert alert-info mt-2">
                        <strong>Catatan:</strong> {{ $reservasi->catatan }}
                    </div>
                    @endif
                    
                    <div class="mt-3">
                        @php
                            $statusColor = [
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'checked_in' => 'primary',
                                'checked_out' => 'success',
                                'cancelled' => 'danger'
                            ][$reservasi->status] ?? 'secondary';
                        @endphp
                        <div class="alert alert-{{ $statusColor }}">
                            <strong>Status:</strong> {{ ucfirst($reservasi->status) }}
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                        
                        @if($reservasi->status == 'pending')
                            <button type="button" class="btn btn-danger" onclick="confirmCancel()">Batalkan Reservasi</button>
                            <form id="cancel-form" action="{{ route('user.reservasi.cancel', $reservasi->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmCancel() {
    Swal.fire({
        title: 'Batalkan Reservasi?',
        text: "Reservasi yang dibatalkan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, batalkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('cancel-form').submit();
        }
    });
}
</script>
@endsection