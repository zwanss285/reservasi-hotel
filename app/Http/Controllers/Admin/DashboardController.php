<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Kamar;
use App\Models\TypeKamar;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek role user
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak!');
        }

        // Statistik Utama
        $totalKamar = Kamar::count();
        $totalKamarTersedia = Kamar::where('status', 'tersedia')->count();
        $totalKamarTerisi = Kamar::where('status', 'terisi')->count();
        $totalKamarMaintenance = Kamar::where('status', 'maintenance')->count();
        
        $totalReservasi = Reservasi::count();
        $totalReservasiPending = Reservasi::where('status', 'pending')->count();
        $totalReservasiConfirmed = Reservasi::where('status', 'confirmed')->count();
        $totalReservasiCheckIn = Reservasi::where('status', 'checked_in')->count();
        $totalReservasiCheckOut = Reservasi::where('status', 'checked_out')->count();
        $totalReservasiCancelled = Reservasi::where('status', 'cancelled')->count();
        
        // Total pendapatan dari pembayaran yang sudah lunas
        $totalPendapatan = Pembayaran::where('status', 'lunas')->sum('jumlah_pembayaran');
        $totalCustomer = User::where('role', 'customer')->count();
        
        // ========== GRAFIK RESERVASI PER BULAN ==========
        $reservasiPerBulan = Reservasi::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        // Siapkan data untuk 12 bulan (Jan-Des)
        $chartReservasiData = array_fill(1, 12, 0);
        foreach ($reservasiPerBulan as $data) {
            $chartReservasiData[$data->bulan] = $data->total;
        }
        
        // ========== GRAFIK PENDAPATAN PER BULAN ==========
        $pendapatanPerBulan = Pembayaran::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(jumlah_pembayaran) as total')
            )
            ->where('status', 'lunas')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        // Siapkan data untuk 12 bulan
        $chartPendapatanData = array_fill(1, 12, 0);
        foreach ($pendapatanPerBulan as $data) {
            $chartPendapatanData[$data->bulan] = (int)$data->total;
        }
        
        // Data untuk label bulan
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        
        // Data reservasi terbaru
        $reservasiTerbaru = Reservasi::with(['user', 'kamar.typeKamar'])
            ->latest()
            ->take(10)
            ->get();
        
        // Data pembayaran menunggu verifikasi
        $pembayaranMenunggu = Pembayaran::with(['reservasi.user', 'reservasi.kamar'])
            ->where('status', 'menunggu_verifikasi')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalKamar',
            'totalKamarTersedia',
            'totalKamarTerisi',
            'totalKamarMaintenance',
            'totalReservasi',
            'totalReservasiPending',
            'totalReservasiConfirmed',
            'totalReservasiCheckIn',
            'totalReservasiCheckOut',
            'totalReservasiCancelled',
            'totalPendapatan',
            'totalCustomer',
            'chartReservasiData',
            'chartPendapatanData',
            'bulanLabels',
            'reservasiTerbaru',
            'pembayaranMenunggu'
        ));
    }
}