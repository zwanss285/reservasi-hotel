<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function upload(Request $request, $reservasi_id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $reservasi = Reservasi::where('user_id', auth()->id())
            ->where('id', $reservasi_id)
            ->firstOrFail();

        if ($reservasi->status !== 'pending') {
            return redirect()->back()->with('error', 'Reservasi sudah diproses, tidak dapat upload bukti lagi.');
        }

        // Upload file
        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $filename);

        // Update atau create pembayaran
        $pembayaran = Pembayaran::where('reservasi_id', $reservasi->id)->first();
        
        if ($pembayaran) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_pembayaran && file_exists(public_path('uploads/bukti/' . $pembayaran->bukti_pembayaran))) {
                unlink(public_path('uploads/bukti/' . $pembayaran->bukti_pembayaran));
            }
            
            $pembayaran->update([
                'bukti_pembayaran' => $filename,
                'status' => 'menunggu_verifikasi'
            ]);
        } else {
            Pembayaran::create([
                'reservasi_id' => $reservasi->id,
                'metode_pembayaran' => 'transfer',
                'jumlah_pembayaran' => $reservasi->total_harga,
                'bukti_pembayaran' => $filename,
                'status' => 'menunggu_verifikasi',
                'tanggal_pembayaran' => null,
            ]);
        }

        return redirect()->route('user.reservasi.show', $reservasi->id)
            ->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu verifikasi dari admin.');
    }
}