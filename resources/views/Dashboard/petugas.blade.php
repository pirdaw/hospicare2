<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Petugas — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar {
            background-color: #778d8d !important;
        }

        .topbar {
            background-color: #f7cbca !important;
        }

        .card-header {
            background-color: #a1bfbc !important;
            color: #4F6F6F;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        @include('components.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.navbar')

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Petugas Pendaftaran</h1>
                        <div>
                            <a href="{{ route('pasien.create') }}" class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-user-plus"></i> Pasien Baru
                            </a>
                            <a href="{{ route('kunjungan.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Daftarkan Kunjungan
                            </a>
                        </div>
                    </div>

                    {{-- Statistik Hari Ini --}}
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                        Kunjungan Hari Ini</div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['total_hari_ini'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pasien Baru
                                    </div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['pasien_baru'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu
                                    </div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['menunggu'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['selesai'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar Kunjungan Hari Ini --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Antrian Kunjungan Hari Ini</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>Poli Tujuan</th>
                                            <th>Keluhan</th>
                                            <th>Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kunjungan_hari_ini as $i => $k)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $k->pasien->nama ?? '-' }}</td>
                                                <td>{{ $k->poli->nama_poli ?? '-' }}</td>
                                                <td>{{ Str::limit($k->keluhan, 40) }}</td>
                                                <td>{{ $k->jenis_pembayaran }}</td>
                                                <td>
                                                    @php
                                                        $badge = match ($k->status) {
                                                            'menunggu' => 'warning',
                                                            'dalam_pemeriksaan' => 'info',
                                                            'selesai' => 'success',
                                                            default => 'secondary',
                                                        };
                                                    @endphp
                                                    <span
                                                        class="badge badge-{{ $badge }}">{{ ucfirst(str_replace('_', ' ', $k->status)) }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('kunjungan.show', $k) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-muted">Belum ada kunjungan hari ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('components.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>