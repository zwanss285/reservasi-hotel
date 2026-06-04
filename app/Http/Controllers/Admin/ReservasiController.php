<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // Menampilkan daftar semua reservasi
    public function index()
    {
        $reservasis = Reservasi::with(['user', 'kamar.typeKamar'])
            ->latest()
            ->paginate(10);
        
        return view('admin.reservasi.index', compact('reservasis'));
    }
    
    // Menampilkan detail reservasi
    public function show($id)
    {
        $reservasi = Reservasi::with(['user', 'kamar.typeKamar', 'pembayaran'])
            ->findOrFail($id);
        
        return view('admin.reservasi.show', compact('reservasi'));
    }
    
    // Update status reservasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled'
        ]);
        
        $reservasi = Reservasi::findOrFail($id);
        $oldStatus = $reservasi->status;
        $reservasi->update(['status' => $request->status]);
        
        // Jika status berubah menjadi cancelled, kembalikan status kamar
        if ($request->status == 'cancelled' && $oldStatus != 'cancelled') {
            $reservasi->kamar->update(['status' => 'tersedia']);
        }
        
        // Jika status berubah menjadi checked_out, kembalikan status kamar
        if ($request->status == 'checked_out') {
            $reservasi->kamar->update(['status' => 'tersedia']);
        }
        
        // Jika status berubah menjadi checked_in, ubah status kamar menjadi terisi
        if ($request->status == 'checked_in') {
            $reservasi->kamar->update(['status' => 'terisi']);
        }
        
        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Status reservasi berhasil diupdate');
    }
    
    // Verifikasi pembayaran reservasi
    public function verifyPayment($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        // Update status reservasi menjadi confirmed
        $reservasi->update(['status' => 'confirmed']);
        
        // Update status pembayaran
        $pembayaran = Pembayaran::where('reservasi_id', $id)->first();
        if ($pembayaran) {
            $pembayaran->update([
                'status' => 'lunas',
                'tanggal_pembayaran' => now()
            ]);
        }
        
        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }
}