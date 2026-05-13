<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            Hospicare
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pendaftaran
    </div>

    <!-- Pasien Baru -->
    <li class="nav-item {{ request()->is('formpasienbaru') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/formpasienbaru') }}">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Pasien Baru</span>
        </a>
    </li>

    <!-- Pasien Lama -->
    <li class="nav-item {{ request()->is('formpasienlama') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/formpasienlama') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pasien Lama</span>
        </a>
    </li>

    <div class="sidebar-heading">
        Poli
    </div>

    <!-- SOAP -->
    <li class="nav-item {{ request()->is('formpoli') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/formpoli') }}">
            <i class="fas fa-fw fa-notes-medical"></i>
            <span>SOAP Form</span>
        </a>
    </li>

    <div class="sidebar-heading">
        Kepala RM
    </div>

    <!-- Data Kunjungan -->
    <li class="nav-item {{ request()->is('datakunjungan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/datakunjungan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Kunjungan</span>
        </a>
    </li>

</ul> 