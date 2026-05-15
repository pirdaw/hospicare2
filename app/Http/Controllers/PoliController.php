<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        // pakai paginate agar konsisten & siap untuk data banyak
        $polis = Poli::latest()->paginate(10);
        return view('poli.index', compact('polis'));
    }

    public function create()
    {
        return view('poli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255|unique:polis,nama_poli',
        ], [
            'nama_poli.required' => 'Nama poli wajib diisi.',
            'nama_poli.unique'   => 'Nama poli sudah ada.',
        ]);

        Poli::create($request->only('nama_poli'));

        return redirect()->route('poli.index')
            ->with('success', 'Poli berhasil ditambahkan.');
    }

    public function edit(Poli $poli)
    {
        return view('poli.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255|unique:polis,nama_poli,' . $poli->id,
        ], [
            'nama_poli.required' => 'Nama poli wajib diisi.',
            'nama_poli.unique'   => 'Nama poli sudah ada.',
        ]);

        $poli->update($request->only('nama_poli'));

        return redirect()->route('poli.index')
            ->with('success', 'Poli berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
{
    // Cek apakah masih ada kunjungan atau tenaga kesehatan terkait
    if ($poli->kunjungans()->exists()) {
        return redirect()->route('poli.index')
            ->with('error', 'Poli tidak bisa dihapus karena masih memiliki data kunjungan.');
    }

    if ($poli->tenagaKesehatans()->exists()) {
        return redirect()->route('poli.index')
            ->with('error', 'Poli tidak bisa dihapus karena masih memiliki tenaga kesehatan terdaftar.');
    }

    $poli->delete();
    return redirect()->route('poli.index')
        ->with('success', 'Poli berhasil dihapus.');
}
}
