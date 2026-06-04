<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use App\Http\Controllers\Controller; // Add this line
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // Tampilkan semua pembayaran dengan relasi reservasi
         $pembayarans = Pembayaran::with(['reservasi.user', 'reservasi.kamar'])
             ->latest()
             ->paginate(10);
         
         return view('admin.pembayaran.index', compact('pembayarans'));
     }
 
     /**
      * Verifikasi pembayaran
      */
     public function verify($id)
     {
         $pembayaran = Pembayaran::findOrFail($id);
         
         $pembayaran->update([
             'status' => 'lunas',
             'tanggal_pembayaran' => now()
         ]);
         
         // Update status reservasi menjadi confirmed
         if ($pembayaran->reservasi) {
             $pembayaran->reservasi->update(['status' => 'confirmed']);
         }
         
         return redirect()->route('admin.pembayaran.index')
             ->with('success', 'Pembayaran berhasil diverifikasi');
     }
 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pembayaran $pembayaran)
    {
        //
    }
}
