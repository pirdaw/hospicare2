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
    public function index(Request $request)
    {
        $query = TenagaKesehatan::with(['user', 'poli'])->latest();

        // Search nama / email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter poli
        if ($request->filled('poli_id')) {
            $query->where('poli_id', $request->poli_id);
        }

        $tenagaKesehatans = $query->paginate(15)->withQueryString();
        $polis             = Poli::orderBy('nama_poli')->get();

        return view('tenaga.index', compact('tenagaKesehatans', 'polis'));
    }

    public function create()
    {
        $polis = Poli::orderBy('nama_poli')->get();
        return view('tenaga.create', compact('polis'));
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
        ], [
            'nama.required'     => 'Nama wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'jenis.required'    => 'Jenis tenaga kesehatan wajib dipilih.',
        ]);

        // Ambil role_id secara dinamis (tidak hardcode angka)
        $roleId = Role::where('nama_role', 'tenaga_kesehatan')->value('id');

        if (!$roleId) {
            return back()->with('error', 'Role tenaga_kesehatan tidak ditemukan. Pastikan seeder sudah dijalankan.');
        }

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
    ->with('success', 'Tenaga kesehatan berhasil ditambahkan.');
    }

    public function show(TenagaKesehatan $tenagaKesehatan)
    {
        $tenagaKesehatan->load('user', 'poli', 'pemeriksaans.kunjungan.pasien');
        return view('tenaga.show', compact('tenagaKesehatan'));
    }

    public function edit(TenagaKesehatan $tenagaKesehatan)
    {
        $polis = Poli::orderBy('nama_poli')->get();
        $tenagaKesehatan->load('user');
        return view('tenaga.edit', compact('tenagaKesehatan', 'polis'));
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
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'jenis.required' => 'Jenis tenaga kesehatan wajib dipilih.',
        ]);

        // Update data user
        $tenagaKesehatan->user->update($request->only('nama', 'no_hp', 'alamat'));

        // Update data tenaga kesehatan
        $tenagaKesehatan->update($request->only('jenis', 'poli_id', 'no_str'));

        return redirect()
            ->route('tenaga.index')
            ->with('success', 'Data tenaga kesehatan berhasil diperbarui.');
    }

    public function destroy(TenagaKesehatan $tenagaKesehatan)
    {
        // Hapus user → cascade ke tenaga_kesehatans otomatis
        $tenagaKesehatan->user->delete();

        return redirect()
            ->route('tenaga.index')
            ->with('success', 'Tenaga kesehatan berhasil dihapus.');
    }
}