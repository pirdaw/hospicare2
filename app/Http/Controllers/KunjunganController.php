<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'poli'])
            ->latest()
            ->paginate(15);

        return view('kunjungan.index', compact('kunjungans'));
    }

    public function create(Request $request)
    {
        $polis = Poli::all();
        $pasien = $request->pasien_id
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
            'keluhan' => 'required|string',
            'jenis_pembayaran' => 'required|in:BPJS,Umum,Asuransi',
            'rujukan_dari' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,dalam_pemeriksaan,selesai',
        ]);

        $kunjungan = Kunjungan::create($request->all());

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Kunjungan berhasil didaftarkan.');
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load('pasien', 'poli', 'pemeriksaan.tenagaKesehatan.user');
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit(Kunjungan $kunjungan)
    {
        $polis = Poli::all();
        return view('kunjungan.edit', compact('kunjungan', 'polis'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'jenis_pembayaran' => 'required|in:BPJS,Umum,Asuransi',
            'rujukan_dari' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,dalam_pemeriksaan,selesai',
        ]);

        $kunjungan->update($request->all());

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil dihapus.');
    }
}
