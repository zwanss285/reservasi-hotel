@extends('layouts.user')

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
                    <!-- Detail Reservasi -->
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr><th>Kode Booking</th><td>: {{ $reservasi->kode_booking }}</td></tr>
                                <tr><th>Nama Tamu</th><td>: {{ $reservasi->nama_tamu }}</td></tr>
                                <tr><th>No. Telepon</th><td>: {{ $reservasi->no_telepon }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr><th>Kamar</th><td>: {{ $reservasi->kamar->nomor_kamar ?? '-' }}</td></tr>
                                <tr><th>Check In</th><td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_in)) }}</td></tr>
                                <tr><th>Check Out</th><td>: {{ date('d/m/Y', strtotime($reservasi->tanggal_check_out)) }}</td></tr>
                                <tr><th>Total Harga</th><td>: Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td></tr>
                            </table>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="alert alert-{{ $reservasi->status == 'pending' ? 'warning' : 'success' }} mt-3">
                        <strong>Status:</strong> {{ ucfirst($reservasi->status) }}
                    </div>

                    <!-- Form Upload Bukti -->
                    @if($reservasi->status == 'pending')
                    <div class="card mt-3">
                        <div class="card-header bg-warning">
                            <h6 class="mb-0"><i class="fas fa-upload me-2"></i> Upload Bukti Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <strong>Instruksi Pembayaran:</strong><br>
                                Transfer ke rekening berikut:<br>
                                <strong>BCA:</strong> 1234567890 a/n Hotel Conview<br>
                                <strong>BRI:</strong> 0987654321 a/n Hotel Conview
                            </div>
                            
                            <form action="{{ route('user.pembayaran.upload', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Bukti Transfer</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                    <small class="text-muted">Format: JPG, PNG, JPEG (Max 2MB)</small>
                                </div>
                                
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Bukti
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                    <!-- Tampilkan Bukti Jika Sudah Ada -->
                    @if($reservasi->pembayaran && $reservasi->pembayaran->bukti_pembayaran)
                    <div class="card mt-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-receipt me-2"></i> Bukti Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ asset('uploads/bukti/' . $reservasi->pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-eye me-2"></i> Lihat Bukti
                            </a>
                            <span class="badge bg-{{ $reservasi->pembayaran->status == 'lunas' ? 'success' : 'warning' }} ms-2">
                                {{ $reservasi->pembayaran->status == 'lunas' ? 'Sudah Diverifikasi' : 'Menunggu Verifikasi' }}
                            </span>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('user.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                        @if($reservasi->status == 'pending')
                            <button type="button" class="btn btn-danger" onclick="confirmCancel()">Batalkan</button>
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