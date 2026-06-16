<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Kunjungan — Hospicare</title>
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
            padding-left: 12px;
            margin-bottom: 16px;
        }

        .badge-menunggu {
            background-color: #f6c23e;
            color: #333;
        }

        .badge-diperiksa {
            background-color: #36b9cc;
            color: #fff;
        }

        .badge-selesai {
            background-color: #1cc88a;
            color: #fff;
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Kunjungan</h1>
                        <div>
                            @if(in_array(Auth::user()->role->nama_role ?? '', ['admin', 'petugas_pendaftaran']))
                                <a href="{{ route('kunjungan.edit', $kunjungan) }}" class="btn btn-warning btn-sm mr-1">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                            @endif
                            <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary btn-sm">
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
                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <i class="fas fa-info-circle mr-1"></i> {{ session('info') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    <div class="row">
                        {{-- Info Pasien --}}
                        <div class="col-md-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-user mr-1"></i> Data Pasien
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="140"><strong>Nama</strong></td>
                                            <td>: {{ $kunjungan->pasien->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIK</strong></td>
                                            <td>: {{ $kunjungan->pasien->nik ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin</strong></td>
                                            <td>:
                                                {{ $kunjungan->pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Umur</strong></td>
                                            <td>: {{ $kunjungan->pasien->umur ?? '-' }} tahun</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gol. Darah</strong></td>
                                            <td>: {{ $kunjungan->pasien->golongan_darah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat</strong></td>
                                            <td>: {{ $kunjungan->pasien->alamat ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Info Kunjungan --}}
                        <div class="col-md-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-clipboard-list mr-1"></i> Data Kunjungan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="160"><strong>Poli</strong></td>
                                            <td>: {{ $kunjungan->poli->nama_poli ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Kunjungan</strong></td>
                                            <td>: {{ $kunjungan->tanggal_kunjungan?->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Keluhan</strong></td>
                                            <td>: {{ $kunjungan->keluhan }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Pembayaran</strong></td>
                                            <td>: <span
                                                    class="badge badge-info">{{ strtoupper($kunjungan->jenis_pembayaran) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Rujukan Dari</strong></td>
                                            <td>: {{ $kunjungan->rujukan_dari ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            <td>:
                                                @if($kunjungan->status === 'menunggu')
                                                    <span class="badge badge-menunggu px-2 py-1">Menunggu</span>
                                                @elseif($kunjungan->status === 'diperiksa')
                                                    <span class="badge badge-diperiksa px-2 py-1">Diperiksa</span>
                                                @else
                                                    <span class="badge badge-selesai px-2 py-1">Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Didaftarkan oleh</strong></td>
                                            <td>: {{ $kunjungan->user->nama ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Pemeriksaan / SOAP --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-notes-medical mr-1"></i> Data Pemeriksaan (SOAP)
                            </h6>
                            {{-- FIX: ganti @can dengan pengecekan role langsung --}}
                            @php $userRole = Auth::user()->role->nama_role ?? ''; @endphp
                            @if(!$kunjungan->pemeriksaan)
                                @if(in_array($userRole, ['admin', 'tenaga_kesehatan']))
                                    <a href="{{ route('pemeriksaan.create', $kunjungan) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus mr-1"></i> Input Pemeriksaan
                                    </a>
                                @endif
                            @else
                                @if(in_array($userRole, ['admin', 'tenaga_kesehatan']))
                                    <a href="{{ route('pemeriksaan.edit', $kunjungan->pemeriksaan) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit mr-1"></i> Edit Pemeriksaan
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="card-body">
                            @if(!$kunjungan->pemeriksaan)
                                <p class="text-center text-muted my-4">
                                    <i class="fas fa-file-medical fa-2x mb-2 d-block"></i>
                                    Belum ada data pemeriksaan untuk kunjungan ini.
                                </p>
                            @else
                                @php $p = $kunjungan->pemeriksaan; @endphp

                                {{-- Tanda Vital --}}
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h6 class="font-weight-bold text-gray-700 mb-3">
                                            <i class="fas fa-heartbeat mr-1 text-danger"></i> Tanda Vital
                                        </h6>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <div class="card border-left-danger">
                                            <div class="card-body py-2 px-3">
                                                <div class="text-xs text-danger font-weight-bold mb-1">SUHU</div>
                                                <div class="h5 mb-0">{{ $p->suhu ? $p->suhu . ' °C' : '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <div class="card border-left-warning">
                                            <div class="card-body py-2 px-3">
                                                <div class="text-xs text-warning font-weight-bold mb-1">TENSI</div>
                                                <div class="h5 mb-0">{{ $p->tensi ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <div class="card border-left-info">
                                            <div class="card-body py-2 px-3">
                                                <div class="text-xs text-info font-weight-bold mb-1">NADI</div>
                                                <div class="h5 mb-0">{{ $p->nadi ? $p->nadi . ' x/mnt' : '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <div class="card border-left-success">
                                            <div class="card-body py-2 px-3">
                                                <div class="text-xs text-success font-weight-bold mb-1">RESPIRASI</div>
                                                <div class="h5 mb-0">{{ $p->respirasi ? $p->respirasi . ' x/mnt' : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SOAP --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="soap-section mb-3">
                                            <strong class="text-primary">S — Subjective</strong>
                                            <p class="mt-1 mb-0">{{ $p->subjective ?? '-' }}</p>
                                        </div>
                                        <div class="soap-section mb-3">
                                            <strong class="text-success">O — Objective</strong>
                                            <p class="mt-1 mb-0">{{ $p->objective ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="soap-section mb-3">
                                            <strong class="text-warning">A — Assessment</strong>
                                            <p class="mt-1 mb-0">{{ $p->assessment ?? '-' }}</p>
                                        </div>
                                        <div class="soap-section mb-3">
                                            <strong class="text-danger">P — Plan</strong>
                                            <p class="mt-1 mb-0">{{ $p->plan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <small class="text-muted">
                                    Diperiksa oleh: <strong>{{ $p->tenagaKesehatan->user->nama ?? '-' }}</strong>
                                    pada {{ $p->tanggal_pemeriksaan?->format('d/m/Y H:i') }}
                                </small>
                            @endif
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