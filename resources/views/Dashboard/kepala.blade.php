<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Kepala RM — Hospicare</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Kepala Rekam Medis</h1>
                        <small class="text-muted">Bulan: {{ now()->translatedFormat('F Y') }}</small>
                    </div>

                    {{-- Statistik --}}
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pasien
                                        Terdaftar</div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['total_pasien'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kunjungan
                                        Bulan Ini</div>
                                    <div class="h5 font-weight-bold text-gray-800">
                                        {{ $stats['total_kunjungan_bulan_ini'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kunjungan Hari
                                        Ini</div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['kunjungan_hari_ini'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Poli
                                        Aktif</div>
                                    <div class="h5 font-weight-bold text-gray-800">{{ $stats['total_poli'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Kunjungan per Poli --}}
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">Kunjungan per Poli (Bulan Ini)</h6>
                                </div>
                                <div class="card-body">
                                    @forelse($per_poli as $poli)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>{{ $poli->nama_poli }}</span>
                                                <strong>{{ $poli->kunjungans_count }}</strong>
                                            </div>
                                            @php
                                                $max = $per_poli->max('kunjungans_count') ?: 1;
                                                $pct = round(($poli->kunjungans_count / $max) * 100);
                                            @endphp
                                            <div class="progress" style="height:8px;">
                                                <div class="progress-bar bg-success" style="width:{{ $pct }}%"></div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted small">Belum ada data.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Kunjungan Terbaru --}}
                        <div class="col-md-8 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold">Kunjungan Terbaru</h6>
                                    <a href="{{ route('kunjungan.index') }}" class="btn btn-sm btn-primary">Lihat
                                        Semua</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 text-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Pasien</th>
                                                    <th>Poli</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($kunjungan_terbaru as $k)
                                                    <tr>
                                                        <td>{{ $k->pasien->nama ?? '-' }}</td>
                                                        <td>{{ $k->poli->nama_poli ?? '-' }}</td>
                                                        <td>{{ $k->tanggal_kunjungan->format('d/m/Y') }}</td>
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
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-muted p-3">Belum ada kunjungan.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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