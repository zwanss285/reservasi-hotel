@extends('layouts.frontend')

@section('title', 'Reservasi Saya')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Riwayat Reservasi Saya</h5>
                </div>
                <div class="card-body">
                    @if($reservasis->isEmpty())
                        <div class="alert alert-info">
                            Anda belum memiliki reservasi. 
                            <a href="{{ route('user.dashboard') }}" class="alert-link">Pesan kamar sekarang</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Booking</th>
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
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kode_booking }}</td>
                                        <td>{{ $item->kamar->nomor_kamar ?? '-' }} ({{ $item->kamar->typeKamar->nama_type ?? '-' }})</td>
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
                                            <a href="{{ route('user.reservasi.show', $item->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            @if($item->status == 'pending')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancel({{ $item->id }})">
                                                <i class="fas fa-times"></i> Batal
                                            </button>
                                            <form id="cancel-form-{{ $item->id }}" action="{{ route('user.reservasi.cancel', $item->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmCancel(id) {
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
            document.getElementById('cancel-form-' + id).submit();
        }
    });
}
</script>
@endsection