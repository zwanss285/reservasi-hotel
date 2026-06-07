@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Dashboard Admin - Verifikasi Pembayaran</h5>
    </div>
    <div class="card-body">
        @if($pembayarans->isEmpty())
            <div class="alert alert-warning">
                <strong>Belum ada data pembayaran.</strong> 
                Silakan buat reservasi terlebih dahulu.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Booking</th>
                        <th>Nama Tamu</th>
                        <th>Total Harga</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Alasan Penolakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayarans as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->reservasi->kode_booking ?? '-' }}</td>
                        <td>{{ $item->reservasi->nama_tamu ?? '-' }}</td>
                        <td>Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>
                            @if($item->bukti_pembayaran)
                                <a href="{{ asset('uploads/bukti/' . $item->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye me-1"></i> Lihat Bukti
                                </a>
                            @else
                                <span class="text-muted">Belum upload</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'lunas')
                                <span class="badge bg-success">Lunas ✓</span>
                            @elseif($item->status == 'menunggu_verifikasi')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                @elseif($item->status == 'refund')
                                <span class="text-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @else
                                <span class="badge bg-secondary">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'ditolak')
                                <span class="text-danger">{{ $item->alasan_penolakan ?? '-' }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'menunggu_verifikasi')
                                <div class="btn-group" role="group">
                                    <form action="{{ route('admin.pembayaran.verify', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Verifikasi pembayaran ini?')">
                                            <i class="fas fa-check me-1"></i> Terima
                                        </button>
                                    </form>
                                    
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">
                                        <i class="fas fa-times me-1"></i> Tolak
                                    </button>
                                </div>

                                <!-- Modal Tolak -->
                                <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.pembayaran.reject', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Tolak Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="alasan_penolakan" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="alasan_penolakan" rows="3" required placeholder="Contoh: Bukti transfer tidak jelas / nominal kurang / rekening tidak sesuai"></textarea>
                                                        <small class="text-muted">Alasan ini akan ditampilkan ke customer</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @elseif($item->status == 'lunas')
                                <span class="text-success"><i class="fas fa-check-circle"></i> Selesai</span>
                            @elseif($item->status == 'ditolak')
                                <span class="text-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @else
                                <span class="text-muted">Menunggu upload</span>
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

<script>
    // Auto close modal after submit
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = document.getElementById('rejectModal');
        if (myModal) {
            myModal.addEventListener('hidden.bs.modal', function () {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            });
        }
    });
</script>
@endsection