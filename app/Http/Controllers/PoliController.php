<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
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
        ]);

        Poli::create($request->only('nama_poli'));

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    public function edit(Poli $poli)
    {
        return view('poli.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255|unique:polis,nama_poli,' . $poli->id,
        ]);

        $poli->update($request->only('nama_poli'));

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}
