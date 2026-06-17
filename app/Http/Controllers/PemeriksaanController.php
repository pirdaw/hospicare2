<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use App\Models\TenagaKesehatan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function create(Kunjungan $kunjungan)
    {
        if ($kunjungan->pemeriksaan) {
            return redirect()
                ->route('pemeriksaan.show', $kunjungan->pemeriksaan)
                ->with('info', 'Kunjungan ini sudah memiliki data pemeriksaan.');
        }

        $kunjungan->load('pasien', 'poli');

        // ✅ Tambahkan ini:
        $tenagaKesehatans = TenagaKesehatan::with('user')
            ->when($kunjungan->poli_id, fn($q) => $q->where('poli_id', $kunjungan->poli_id))
            ->get();

        return view('pemeriksaan.create', compact('kunjungan', 'tenagaKesehatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id|unique:pemeriksaans,kunjungan_id',
            'tenaga_kesehatan_id' => 'required|exists:tenaga_kesehatans,id',
            'poli_id' => 'nullable|exists:polis,id',
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'suhu' => 'nullable|numeric|min:30|max:45',
            'tensi' => 'nullable|string|max:20',
            'nadi' => 'nullable|integer|min:0|max:300',
            'respirasi' => 'nullable|integer|min:0|max:100',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $pemeriksaan = Pemeriksaan::create($validated);

        // Update status kunjungan menjadi selesai
        $pemeriksaan->kunjungan->update(['status' => 'selesai']);

        return redirect()
            ->route('pemeriksaan.show', $pemeriksaan)
            ->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load('kunjungan.pasien', 'tenagaKesehatan.user', 'poli');
        return view('pemeriksaan.show', compact('pemeriksaan'));
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load('kunjungan.pasien', 'poli');
        return view('pemeriksaan.edit', compact('pemeriksaan'));
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $request->validate([
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'suhu' => 'nullable|numeric|min:30|max:45',
            'tensi' => 'nullable|string|max:20',
            'nadi' => 'nullable|integer|min:0|max:300',
            'respirasi' => 'nullable|integer|min:0|max:100',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $pemeriksaan->update($request->only([
            'subjective',
            'objective',
            'suhu',
            'tensi',
            'nadi',
            'respirasi',
            'assessment',
            'plan',
            'tanggal_pemeriksaan',
        ]));

        return redirect()
            ->route('pemeriksaan.show', $pemeriksaan)
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }
}
