<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with(['reservasi.user', 'reservasi.kamar'])
            ->latest()
            ->paginate(10);
        
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function verify($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        $pembayaran->update([
            'status' => 'lunas',
            'tanggal_pembayaran' => now(),
            'alasan_penolakan' => null
        ]);
        
        if ($pembayaran->reservasi) {
            $pembayaran->reservasi->update(['status' => 'confirmed']);
        }
        
        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        
        $pembayaran->update([
            'status' => 'refund',
            'alasan_penolakan' => $request->alasan_penolakan,
            'tanggal_pembayaran' => null
        ]);

        if ($pembayaran->reservasi) {
            $pembayaran->reservasi->update(['status' => 'pending']);
        }
        
        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran ditolak. Customer akan diinformasikan.');
    }

    // ========== METHOD LAIN ==========
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pembayaran $pembayaran)
    {
        //
    }

    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}