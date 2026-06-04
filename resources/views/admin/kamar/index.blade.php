@extends('layouts.admin')

@section('title', 'Kelola Kamar')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kamar</h5>
        <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Kamar
        </a>
    </div>
    <div class="card-body">
        @if($kamars->isEmpty())
            <div class="alert alert-info">
                Belum ada data kamar. Silakan tambah data baru.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Lantai</th>
                        <th>Harga/Malam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kamars as $index => $kamar)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kamar->nomor_kamar }}</td>
                        <td>{{ $kamar->typeKamar->nama_type ?? '-' }}</td>
                        <td>{{ $kamar->lantai }}</td>
                        <td>Rp {{ number_format($kamar->typeKamar->harga_per_malam ?? 0, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $statusColor = [
                                    'tersedia' => 'success',
                                    'terisi' => 'danger',
                                    'maintenance' => 'warning',
                                    'dibersihkan' => 'info'
                                ][$kamar->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">
                                {{ ucfirst($kamar->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $kamar->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $kamar->id }}" action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection