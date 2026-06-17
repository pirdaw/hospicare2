<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Kunjungan::with(['pasien', 'poli', 'pemeriksaan'])->latest();

        // Filter search (nama pasien atau NIK)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kunjungan', $request->tanggal);
        }

        // Filter status — bisa dari dropdown ('status') atau shortcut sidebar ('filter')
        $statusFilter = $request->filled('status') ? $request->status : $request->filter;
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Filter poli
        if ($request->filled('poli_id')) {
            $query->where('poli_id', $request->poli_id);
        }

        $kunjungans = $query->paginate(15)->withQueryString();
        $polis = Poli::orderBy('nama_poli')->get();

        return view('kunjungan.index', compact('kunjungans', 'polis'));
    }

    public function create(Request $request)
    {
        $polis = Poli::orderBy('nama_poli')->get();
        $pasien = $request->filled('pasien_id')
            ? Pasien::findOrFail($request->pasien_id)
            : null;

        return view('kunjungan.create', compact('polis', 'pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => 'required|exists:polis,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string|max:1000',
            'jenis_pembayaran' => 'required|in:umum,bpjs,swasta',
            'rujukan_dari' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,diperiksa,selesai',
        ], [
            'pasien_id.required' => 'Pasien wajib dipilih.',
            'poli_id.required' => 'Poli wajib dipilih.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'keluhan.required' => 'Keluhan wajib diisi.',
            'jenis_pembayaran.required' => 'Jenis pembayaran wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        // Tambahkan user_id otomatis dari user yang login
        $data = $request->all();
        $data['user_id'] = auth()->id();

        $kunjungan = Kunjungan::create($data);

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Kunjungan berhasil didaftarkan.');
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load('pasien', 'poli', 'user', 'pemeriksaan.tenagaKesehatan.user');
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        $polis = Poli::orderBy('nama_poli')->get();
        return view('kunjungan.edit', compact('kunjungan', 'polis'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string|max:1000',
            'jenis_pembayaran' => 'required|in:umum,bpjs,swasta',
            'rujukan_dari' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,diperiksa,selesai',
        ], [
            'poli_id.required' => 'Poli wajib dipilih.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'keluhan.required' => 'Keluhan wajib diisi.',
            'jenis_pembayaran.required' => 'Jenis pembayaran wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $kunjungan->update($request->only([
            'poli_id',
            'tanggal_kunjungan',
            'keluhan',
            'jenis_pembayaran',
            'rujukan_dari',
            'status',
        ]));

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Kunjungan berhasil dihapus.');
    }

    public function cetak(Request $request)
{
    $kunjungans = Kunjungan::with(['pasien', 'poli'])
        ->when($request->filled('tanggal'), fn($q) => $q->whereDate('tanggal_kunjungan', $request->tanggal))
        ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
        ->orderBy('tanggal_kunjungan', 'desc')
        ->get();

    return view('kunjungan.cetak', compact('kunjungans'));
}
}