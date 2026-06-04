<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with(['kamar.typeKamar'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.reservasi.index', compact('reservasis'));
    }

    public function create($kamar_id)
    {
        $kamar = Kamar::with('typeKamar')->findOrFail($kamar_id);
        
        if ($kamar->status !== 'tersedia') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Maaf, kamar sedang tidak tersedia.');
        }
        
        return view('user.reservasi.create', compact('kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'nama_tamu' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_tamu' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);
        
        $checkIn = strtotime($request->tanggal_check_in);
        $checkOut = strtotime($request->tanggal_check_out);
        $days = ($checkOut - $checkIn) / (60 * 60 * 24);
        $total_harga = $days * $kamar->typeKamar->harga_per_malam;
        
        $kode_booking = 'BOOK-' . strtoupper(Str::random(8));
        
        $reservasi = Reservasi::create([
            'user_id' => auth()->id(),
            'kamar_id' => $request->kamar_id,
            'kode_booking' => $kode_booking,
            'nama_tamu' => $request->nama_tamu,
            'no_telepon' => $request->no_telepon,
            'email' => auth()->user()->email,
            'jumlah_tamu' => $request->jumlah_tamu,
            'tanggal_check_in' => $request->tanggal_check_in,
            'tanggal_check_out' => $request->tanggal_check_out,
            'total_harga' => $total_harga,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        Pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'metode_pembayaran' => 'transfer',
            'jumlah_pembayaran' => $total_harga,
            'status' => 'belum_bayar',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => null,
        ]);
        
        $kamar->update(['status' => 'terisi']);
        
        return redirect()->route('user.reservasi.show', $reservasi->id)
            ->with('success', 'Reservasi berhasil! Silakan lakukan pembayaran.');
    }

    public function show($id)
    {
        $reservasi = Reservasi::with(['kamar.typeKamar', 'pembayaran'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        
        return view('user.reservasi.show', compact('reservasi'));
    }

    public function cancel($id)
    {
        $reservasi = Reservasi::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->findOrFail($id);
        
        $reservasi->update(['status' => 'cancelled']);
        
        if ($reservasi->pembayaran) {
            $reservasi->pembayaran->update(['status' => 'cancelled']);
        }
        
        $reservasi->kamar->update(['status' => 'tersedia']);
        
        return redirect()->route('user.reservasi.index')
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }
}