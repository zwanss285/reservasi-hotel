@extends('layouts.admin')

@section('title', 'Tipe Kamar')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Manajemen Tipe Kamar</h5>
        <a href="{{ route('admin.type-kamar.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Tipe Kamar
        </a>
    </div>
    <div class="card-body">
        @if($typeKamars->isEmpty())
            <div class="alert alert-info">
                Belum ada data tipe kamar. Silakan tambah data baru.
            </div>
        @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tipe</th>
                    <th>Fasilitas</th>
                    <th>Harga/Malam</th>
                    <th>Kapasitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($typeKamars as $index => $type)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $type->nama_type }}</td>
                    <td>{{ Str::limit($type->fasilitas, 50) }}</td>
                    <td>Rp {{ number_format($type->harga_per_malam, 0, ',', '.') }}</td>
                    <td>{{ $type->kapasitas_maksimal }} orang</td>
                    <td>
                        <a href="{{ route('admin.type-kamar.edit', $type->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $type->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="delete-form-{{ $type->id }}" action="{{ route('admin.type-kamar.destroy', $type->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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