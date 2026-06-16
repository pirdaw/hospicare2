<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pemeriksaan — Hospicare</title>
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

        .btn-primary {
            background-color: #f7cbca !important;
            border-color: #f7cbca !important;
            color: #333 !important;
        }

        .btn-primary:hover {
            background-color: #f3b6cf !important;
            border-color: #f3b6cf !important;
        }

        .soap-section {
            border-left: 4px solid #a1bfbc;
            padding: 12px 16px;
            margin-bottom: 16px;
            background: #fafafa;
            border-radius: 0 6px 6px 0;
        }

        .soap-S {
            border-left-color: #4e73df !important;
        }

        .soap-O {
            border-left-color: #1cc88a !important;
        }

        .soap-A {
            border-left-color: #f6c23e !important;
        }

        .soap-P {
            border-left-color: #e74a3b !important;
        }

        .vital-box {
            text-align: center;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .vital-value {
            font-size: 24px;
            font-weight: 700;
        }

        @media print {

            .sidebar,
            .topbar,
            .btn,
            form,
            #sidebarToggle {
                display: none !important;
            }

            #content-wrapper {
                margin: 0 !important;
            }

            .card {
                border: 1px solid #ccc !important;
                box-shadow: none !important;
            }
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Pemeriksaan</h1>
                        <div>
                            <button onclick="window.print()" class="btn btn-secondary btn-sm mr-1">
                                <i class="fas fa-print mr-1"></i> Cetak
                            </button>
                            <a href="{{ route('pemeriksaan.edit', $pemeriksaan) }}" class="btn btn-warning btn-sm mr-1">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('kunjungan.show', $pemeriksaan->kunjungan) }}"
                                class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    {{-- Header Info --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-id-card mr-1"></i> Informasi Pemeriksaan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="160"><strong>Nama Pasien</strong></td>
                                            <td>: <strong>{{ $pemeriksaan->kunjungan->pasien->nama ?? '-' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIK</strong></td>
                                            <td>: {{ $pemeriksaan->kunjungan->pasien->nik ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin</strong></td>
                                            <td>:
                                                {{ $pemeriksaan->kunjungan->pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Umur</strong></td>
                                            <td>: {{ $pemeriksaan->kunjungan->pasien->umur ?? '-' }} tahun</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="160"><strong>Poli</strong></td>
                                            <td>:
                                                {{ $pemeriksaan->poli->nama_poli ?? $pemeriksaan->kunjungan->poli->nama_poli ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Periksa</strong></td>
                                            <td>: {{ $pemeriksaan->tanggal_pemeriksaan?->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pemeriksa</strong></td>
                                            <td>: {{ $pemeriksaan->tenagaKesehatan->user->nama ?? '-' }}
                                                <span
                                                    class="text-muted">({{ ucfirst($pemeriksaan->tenagaKesehatan->jenis ?? '') }})</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Keluhan Awal</strong></td>
                                            <td>: {{ $pemeriksaan->kunjungan->keluhan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tanda Vital --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-heartbeat mr-1 text-danger"></i> Tanda Vital
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="vital-box border-top border-danger border-3">
                                        <div class="text-danger small font-weight-bold mb-1">
                                            <i class="fas fa-thermometer-half mr-1"></i> SUHU
                                        </div>
                                        <div class="vital-value text-danger">
                                            {{ $pemeriksaan->suhu ?? '-' }}
                                        </div>
                                        <small class="text-muted">°C</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="vital-box border-top border-warning border-3">
                                        <div class="text-warning small font-weight-bold mb-1">
                                            <i class="fas fa-tint mr-1"></i> TENSI
                                        </div>
                                        <div class="vital-value text-warning">
                                            {{ $pemeriksaan->tensi ?? '-' }}
                                        </div>
                                        <small class="text-muted">mmHg</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="vital-box border-top border-info border-3">
                                        <div class="text-info small font-weight-bold mb-1">
                                            <i class="fas fa-heart mr-1"></i> NADI
                                        </div>
                                        <div class="vital-value text-info">
                                            {{ $pemeriksaan->nadi ?? '-' }}
                                        </div>
                                        <small class="text-muted">x/menit</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="vital-box border-top border-success border-3">
                                        <div class="text-success small font-weight-bold mb-1">
                                            <i class="fas fa-lungs mr-1"></i> RESPIRASI
                                        </div>
                                        <div class="vital-value text-success">
                                            {{ $pemeriksaan->respirasi ?? '-' }}
                                        </div>
                                        <small class="text-muted">x/menit</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SOAP --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-notes-medical mr-1"></i> Catatan SOAP
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="soap-section soap-S">
                                        <div class="font-weight-bold text-primary mb-2">
                                            S — Subjective
                                            <small class="text-muted font-weight-normal ml-1">(Anamnesis)</small>
                                        </div>
                                        <p class="mb-0">{{ $pemeriksaan->subjective ?: '-' }}</p>
                                    </div>
                                    <div class="soap-section soap-O">
                                        <div class="font-weight-bold text-success mb-2">
                                            O — Objective
                                            <small class="text-muted font-weight-normal ml-1">(Pemeriksaan
                                                Fisik)</small>
                                        </div>
                                        <p class="mb-0">{{ $pemeriksaan->objective ?: '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="soap-section soap-A">
                                        <div class="font-weight-bold text-warning mb-2">
                                            A — Assessment
                                            <small class="text-muted font-weight-normal ml-1">(Diagnosis)</small>
                                        </div>
                                        <p class="mb-0">{{ $pemeriksaan->assessment ?: '-' }}</p>
                                    </div>
                                    <div class="soap-section soap-P">
                                        <div class="font-weight-bold text-danger mb-2">
                                            P — Plan
                                            <small class="text-muted font-weight-normal ml-1">(Rencana Tindakan)</small>
                                        </div>
                                        <p class="mb-0">{{ $pemeriksaan->plan ?: '-' }}</p>
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>