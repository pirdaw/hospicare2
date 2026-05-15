<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::latest()->paginate(15);
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pasiens,nik',
            'umur' => 'required|integer|min:0|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(Pasien $pasien)
    {
        $pasien->load('kunjungans.poli', 'kunjungans.pemeriksaan');
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pasiens,nik,' . $pasien->id,
            'umur' => 'required|integer|min:0|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    // Cari pasien lama berdasarkan NIK (untuk form pendaftaran kunjungan)
    public function cari(Request $request)
    {
        $request->validate(['nik' => 'required|string']);

        $pasien = Pasien::where('nik', $request->nik)->first();

        if (!$pasien) {
            return back()->with('error', 'Pasien dengan NIK tersebut tidak ditemukan.');
        }

        return redirect()->route('kunjungan.create', ['pasien_id' => $pasien->id]);
    }
}
