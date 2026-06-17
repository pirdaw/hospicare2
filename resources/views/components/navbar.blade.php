<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Mobile) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto align-items-center">

        <!-- Badge Role -->
        <li class="nav-item d-none d-sm-flex align-items-center mr-3">
            <span class="badge badge-pill badge-primary px-3 py-2" style="font-size:11px;letter-spacing:.5px;">
                <i class="fas fa-shield-alt mr-1"></i>
                {{ ucfirst(str_replace('_', ' ', Auth::user()->role->nama_role ?? '-')) }}
            </span>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Info User (tanpa dropdown, tanpa logout) -->
        <li class="nav-item d-flex align-items-center">
            <i class="fas fa-user-circle fa-lg text-gray-400 mr-2"></i>
            <div class="d-none d-lg-block lh-1">
                <div class="text-gray-800 small font-weight-bold">{{ Auth::user()->nama }}</div>
                <div class="text-gray-500" style="font-size:11px;">{{ Auth::user()->email }}</div>
            </div>
        </li>

    </ul>
</nav>