<?php

namespace App\Http\Controllers;

use App\Models\TenagaKesehatan;
use App\Models\User;
use App\Models\Poli;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenagaKesehatanController extends Controller
{
    public function index()
    {
        $tenagaKesehatans = TenagaKesehatan::with(['user', 'poli'])
            ->latest()
            ->paginate(15);

        return view('tenaga-kesehatan.index', compact('tenagaKesehatans'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('tenaga-kesehatan.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_hp'    => 'nullable|string|max:20',
            'alamat'   => 'nullable|string',
            'jenis'    => 'required|in:dokter,perawat,bidan,lainnya',
            'poli_id'  => 'nullable|exists:polis,id',
            'no_str'   => 'nullable|string|max:50',
        ]);

        // Ambil role_id secara dinamis — tidak hardcode angka
        $roleId = Role::where('nama_role', 'tenaga_kesehatan')->value('id');

        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'no_hp'    => $request->no_hp,
            'alamat'   => $request->alamat,
            'role_id'  => $roleId,
        ]);

        TenagaKesehatan::create([
            'user_id' => $user->id,
            'jenis'   => $request->jenis,
            'poli_id' => $request->poli_id,
            'no_str'  => $request->no_str,
        ]);

        return redirect()
            ->route('tenaga-kesehatan.index')
            ->with('success', 'Data tenaga kesehatan berhasil ditambahkan.');
    }

    public function show(TenagaKesehatan $tenagaKesehatan)
    {
        $tenagaKesehatan->load('user', 'poli', 'pemeriksaans.kunjungan.pasien');
        return view('tenaga-kesehatan.show', compact('tenagaKesehatan'));
    }

    public function edit(TenagaKesehatan $tenagaKesehatan)
    {
        $polis = Poli::all();
        $tenagaKesehatan->load('user');
        return view('tenaga-kesehatan.edit', compact('tenagaKesehatan', 'polis'));
    }

    public function update(Request $request, TenagaKesehatan $tenagaKesehatan)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'no_hp'   => 'nullable|string|max:20',
            'alamat'  => 'nullable|string',
            'jenis'   => 'required|in:dokter,perawat,bidan,lainnya',
            'poli_id' => 'nullable|exists:polis,id',
            'no_str'  => 'nullable|string|max:50',
        ]);

        $tenagaKesehatan->user->update($request->only('nama', 'no_hp', 'alamat'));
        $tenagaKesehatan->update($request->only('jenis', 'poli_id', 'no_str'));

        return redirect()
            ->route('tenaga-kesehatan.index')
            ->with('success', 'Data tenaga kesehatan berhasil diperbarui.');
    }

    public function destroy(TenagaKesehatan $tenagaKesehatan)
    {
        // Hapus user-nya → otomatis cascade ke tenaga_kesehatans
        $tenagaKesehatan->user->delete();

        return redirect()
            ->route('tenaga-kesehatan.index')
            ->with('success', 'Data tenaga kesehatan berhasil dihapus.');
    }
}