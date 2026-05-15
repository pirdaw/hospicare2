<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\TenagaKesehatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /** Dashboard Admin — lihat semua statistik */
    public function admin()
    {
        $stats = [
            'total_pasien' => Pasien::count(),
            'total_user' => User::count(),
            'total_poli' => Poli::count(),
            'total_nakes' => TenagaKesehatan::count(),
            'kunjungan_hari_ini' => Kunjungan::whereDate('tanggal_kunjungan', today())->count(),
            'menunggu' => Kunjungan::where('status', 'menunggu')->count(),
        ];

        $kunjungan_terbaru = Kunjungan::with(['pasien', 'poli'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'kunjungan_terbaru'));
    }

    /** Dashboard Petugas Pendaftaran — fokus antrian & pendaftaran hari ini */
    public function petugas()
    {
        $kunjungan_hari_ini = Kunjungan::with(['pasien', 'poli'])
            ->whereDate('tanggal_kunjungan', today())
            ->latest()
            ->get();

        $stats = [
            'total_hari_ini' => $kunjungan_hari_ini->count(),
            'pasien_baru' => $kunjungan_hari_ini->filter(fn($k) =>
                $k->pasien?->created_at->isToday())->count(),
            'menunggu' => $kunjungan_hari_ini->where('status', 'menunggu')->count(),
            'selesai' => $kunjungan_hari_ini->where('status', 'selesai')->count(),
        ];

        return view('dashboard.petugas', compact('kunjungan_hari_ini', 'stats'));
    }

    /** Dashboard Tenaga Kesehatan — antrian pasien yang perlu diperiksa */
    public function nakes()
    {
        $user = Auth::user();
        $nakes = $user->tenagaKesehatan;

        // Kunjungan menunggu di poli yang sama dengan nakes ini
        $antrian = Kunjungan::with(['pasien', 'poli'])
            ->where('status', 'menunggu')
            ->when($nakes?->poli_id, fn($q) => $q->where('poli_id', $nakes->poli_id))
            ->whereDate('tanggal_kunjungan', today())
            ->oldest('tanggal_kunjungan')
            ->get();

        $sudah_diperiksa = Kunjungan::with(['pasien'])
            ->where('status', 'selesai')
            ->when($nakes?->poli_id, fn($q) => $q->where('poli_id', $nakes->poli_id))
            ->whereDate('tanggal_kunjungan', today())
            ->count();

        return view('dashboard.nakes', compact('antrian', 'sudah_diperiksa', 'nakes'));
    }

    /** Dashboard Kepala RM — laporan & rekap data */
    public function kepala()
    {
        $stats = [
            'total_kunjungan_bulan_ini' => Kunjungan::whereMonth('tanggal_kunjungan', now()->month)->count(),
            'total_pasien' => Pasien::count(),
            'total_poli' => Poli::count(),
            'kunjungan_hari_ini' => Kunjungan::whereDate('tanggal_kunjungan', today())->count(),
        ];

        // Kunjungan per poli bulan ini
        $per_poli = Poli::withCount([
            'kunjungans' => fn($q) =>
                $q->whereMonth('tanggal_kunjungan', now()->month)
        ])->get();

        $kunjungan_terbaru = Kunjungan::with(['pasien', 'poli'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.kepala', compact('stats', 'per_poli', 'kunjungan_terbaru'));
    }
}
