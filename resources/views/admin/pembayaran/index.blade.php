@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Dashboard Admin - Verifikasi Pembayaran</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pembayaran</th>
                    <th>ID Reservasi</th>
                    <th>Total Harga</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->reservasi->kode_booking }}</td>
                    <td>Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td>
                        @if($item->bukti_pembayaran)
                        <a href="{{ asset('uploads/' . $item->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'lunas')
                        <span class="badge bg-success">Sudah Diverifikasi</span>
                        @else
                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status != 'lunas')
                        <form action="{{ route('admin.pembayaran.verify', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection