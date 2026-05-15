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

        <li class="nav-item {{ request()->routeIs('kunjungan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Kunjungan</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Pemeriksaan</div>

        <li class="nav-item {{ request()->routeIs('pemeriksaan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-notes-medical"></i>
                <span>SOAP / Pemeriksaan</span>
            </a>
        </li>

        {{-- ===== PETUGAS PENDAFTARAN ===== --}}
    @elseif($role === 'petugas_pendaftaran')

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
                <span>Pasien Lama</span>
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

        <li class="nav-item {{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
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

        <li class="nav-item {{ request()->routeIs('pemeriksaan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-notes-medical"></i>
                <span>SOAP / Pemeriksaan</span>
            </a>
        </li>

        {{-- ===== KEPALA RM ===== --}}
    @elseif($role === 'kepala_rm')

        <div class="sidebar-heading">Laporan</div>

        <li class="nav-item {{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kunjungan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Kunjungan</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pasien.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pasien</span>
            </a>
        </li>

    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>