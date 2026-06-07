@php $role = Auth::user()->role->nama_role ?? ''; @endphp

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-heartbeat"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Hospicare</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard (link sesuai role) -->
    <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
        <a class="nav-link" href="@if($role === 'admin') {{ route('dashboard.admin') }}
        @elseif($role === 'petugas_pendaftaran') {{ route('dashboard.petugas') }}
        @elseif($role === 'tenaga_kesehatan') {{ route('dashboard.nakes') }}
        @else {{ route('dashboard.kepala') }}
        @endif">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    {{-- ===== ADMIN ONLY ===== --}}
    @if($role === 'admin')

        <div class="sidebar-heading">Master Data</div>

        <li class="nav-item {{ request()->routeIs('poli.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('poli.index') }}">
                <i class="fas fa-fw fa-hospital"></i>
                <span>Data Poli</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('tenaga-kesehatan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tenaga-kesehatan.index') }}">
                <i class="fas fa-fw fa-user-md"></i>
                <span>Tenaga Kesehatan</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Pendaftaran</div>

        <li class="nav-item {{ request()->routeIs('pasien.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.create') }}">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Pasien Baru</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pasien</span>
            </a>
        </li>

        <li
            class="nav-item {{ request()->routeIs('kunjungan.*') && !request()->routeIs('pemeriksaan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Kunjungan</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Pemeriksaan</div>

        {{-- FIX: Link SOAP sekarang mengarah ke kunjungan.index dengan filter status menunggu --}}
        <li class="nav-item {{ request()->routeIs('pemeriksaan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index', ['filter' => 'menunggu']) }}">
                <i class="fas fa-fw fa-notes-medical"></i>
                <span>SOAP / Pemeriksaan</span>
            </a>
        </li>

        {{-- ===== PETUGAS PENDAFTARAN ===== --}}
    @elseif($role === 'petugas_pendaftaran')

        <div class="sidebar-heading">Pendaftaran Pasien</div>

        <li class="nav-item {{ request()->routeIs('pasien.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.create') }}">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Pasien Baru</span>
            </a>
        </li>

        <li
            class="nav-item {{ request()->routeIs('pasien.index') || request()->routeIs('pasien.show') || request()->routeIs('pasien.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pasien</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Kunjungan</div>

        <li class="nav-item {{ request()->routeIs('kunjungan.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.create') }}">
                <i class="fas fa-fw fa-plus-circle"></i>
                <span>Daftarkan Kunjungan</span>
            </a>
        </li>

        <li
            class="nav-item {{ request()->routeIs('kunjungan.index') || request()->routeIs('kunjungan.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Antrian Hari Ini</span>
            </a>
        </li>

        {{-- ===== TENAGA KESEHATAN ===== --}}
    @elseif($role === 'tenaga_kesehatan')

        <div class="sidebar-heading">Pemeriksaan</div>

        <li class="nav-item {{ request()->routeIs('dashboard.nakes') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.nakes') }}">
                <i class="fas fa-fw fa-stethoscope"></i>
                <span>Antrian Pasien</span>
            </a>
        </li>

        {{-- FIX: Link SOAP mengarah ke daftar kunjungan (untuk pilih pasien yang akan diperiksa) --}}
        <li
            class="nav-item {{ request()->routeIs('pemeriksaan.*') || request()->routeIs('kunjungan.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-notes-medical"></i>
                <span>Input SOAP</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pemeriksaan.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index', ['filter' => 'selesai']) }}">
                <i class="fas fa-fw fa-file-medical-alt"></i>
                <span>Riwayat Pemeriksaan</span>
            </a>
        </li>

        {{-- ===== KEPALA RM ===== --}}
    @elseif($role === 'kepala_rm')

        <div class="sidebar-heading">Rekam Medis</div>

        <li
            class="nav-item {{ request()->routeIs('kunjungan.index') || request()->routeIs('kunjungan.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Kunjungan</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pasien.index') || request()->routeIs('pasien.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pasien</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pemeriksaan.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index', ['filter' => 'selesai']) }}">
                <i class="fas fa-fw fa-file-medical-alt"></i>
                <span>Laporan Pemeriksaan</span>
            </a>
        </li>

    @endif

    <hr class="sidebar-divider d-none d-md-block">

    {{-- ===== TOMBOL LOGOUT ===== --}}
    <li class="nav-item px-3 pb-4">
        {{-- Form logout disembunyikan, diklik via JS --}}
        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

        <button type="button" onclick="hospiLogout()" style="
                    width:100%;
                    padding:10px 0;
                    background:linear-gradient(135deg,#e74c3c,#c0392b);
                    color:#fff;
                    border:none;
                    border-radius:10px;
                    font-size:13px;
                    font-weight:600;
                    letter-spacing:.5px;
                    cursor:pointer;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    gap:8px;
                    box-shadow:0 3px 10px rgba(192,57,43,.45);
                    transition:opacity .15s;
                " onmouseover="this.style.opacity='.82'" onmouseout="this.style.opacity='1'">
            <i class="fas fa-sign-out-alt" style="font-size:14px;"></i>
            Logout
        </button>
    </li>

    <div class="text-center d-none d-md-inline mb-2">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

{{-- ===== OVERLAY MODAL CUSTOM (tidak bergantung jQuery/Bootstrap JS) ===== --}}
<div id="hospi-logout-overlay" onclick="if(event.target===this) hospiCloseModal()" style="
         display:none;
         position:fixed;
         inset:0;
         background:rgba(0,0,0,.55);
         z-index:9999;
         align-items:center;
         justify-content:center;
         padding:16px;
         backdrop-filter:blur(2px);
     ">
    <div style="
             background:#fff;
             border-radius:16px;
             overflow:hidden;
             width:100%;
             max-width:390px;
             box-shadow:0 20px 60px rgba(0,0,0,.25);
             animation:hospiSlideIn .2s ease;
         ">

        {{-- Header --}}
        <div
            style="background:linear-gradient(135deg,#e74c3c,#c0392b);padding:20px 22px;display:flex;align-items:center;justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:12px;">
                <div
                    style="width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-sign-out-alt" style="font-size:18px;color:#fff;"></i>
                </div>
                <div>
                    <div style="color:#fff;font-weight:700;font-size:15px;line-height:1.2;">Konfirmasi Logout</div>
                    <div style="color:rgba(255,255,255,.65);font-size:11px;">Sesi akan segera diakhiri</div>
                </div>
            </div>
            <button onclick="hospiCloseModal()"
                style="background:rgba(255,255,255,.15);border:none;color:#fff;width:30px;height:30px;border-radius:50%;cursor:pointer;font-size:18px;line-height:1;display:flex;align-items:center;justify-content:center;">
                &times;
            </button>
        </div>

        {{-- Body --}}
        <div style="padding:28px 24px 20px;text-align:center;">
            <div
                style="width:64px;height:64px;border-radius:50%;background:#fff3cd;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="fas fa-question-circle" style="font-size:32px;color:#f39c12;"></i>
            </div>
            <p style="margin:0 0 6px;font-size:16px;font-weight:700;color:#2d3748;">
                Apakah Anda yakin ingin keluar?
            </p>
            <p style="margin:0;font-size:13px;color:#718096;">
                Anda perlu login kembali untuk mengakses sistem.
            </p>
        </div>

        {{-- Footer --}}
        <div style="padding:0 24px 24px;display:flex;gap:10px;">
            <button onclick="hospiCloseModal()"
                style="flex:1;padding:11px 0;border-radius:8px;border:1.5px solid #cbd5e0;background:#fff;color:#4a5568;font-size:14px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:background .15s;"
                onmouseover="this.style.background='#f7fafc'" onmouseout="this.style.background='#fff'">
                <i class="fas fa-times"></i> Batal
            </button>
            <button onclick="document.getElementById('sidebar-logout-form').submit()"
                style="flex:1;padding:11px 0;border-radius:8px;border:none;background:linear-gradient(135deg,#e74c3c,#c0392b);color:#fff;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;box-shadow:0 3px 10px rgba(192,57,43,.4);transition:opacity .15s;"
                onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                <i class="fas fa-sign-out-alt"></i> Ya, Logout
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes hospiSlideIn {
        from {
            opacity: 0;
            transform: translateY(-18px) scale(.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>

<script>
    function hospiLogout() {
        var overlay = document.getElementById('hospi-logout-overlay');
        overlay.style.display = 'flex';
    }
    function hospiCloseModal() {
        var overlay = document.getElementById('hospi-logout-overlay');
        overlay.style.display = 'none';
    }
    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') hospiCloseModal();
    });
</script>