<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Tenaga Kesehatan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .avatar-circle { width: 70px; height: 70px; border-radius: 50%;
                         background: #a1bfbc; display: flex; align-items: center;
                         justify-content: center; font-size: 28px; color: #fff; }
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
                    <h1 class="h3 mb-0 text-gray-800">Detail Tenaga Kesehatan</h1>
                    <div>
                        <a href="{{ route('tenaga-kesehatan.edit', $tenagaKesehatan) }}" class="btn btn-warning btn-sm mr-1">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a href="{{ route('tenaga-kesehatan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="row">
                    {{-- Profil --}}
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Profil</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="avatar-circle mx-auto mb-3">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <h5 class="font-weight-bold">{{ $tenagaKesehatan->user->nama ?? '-' }}</h5>
                                <p class="text-muted mb-2">{{ $tenagaKesehatan->user->email ?? '-' }}</p>
                                <span class="badge badge-primary px-3 py-2">
                                    {{ ucfirst($tenagaKesehatan->jenis) }}
                                </span>
                                @if($tenagaKesehatan->poli)
                                    <br><span class="badge badge-info mt-2 px-3 py-2">
                                        {{ $tenagaKesehatan->poli->nama_poli }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Detail Info --}}
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Informasi Lengkap</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="160"><strong>Nama</strong></td>
                                        <td>: {{ $tenagaKesehatan->user->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>: {{ $tenagaKesehatan->user->email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. HP</strong></td>
                                        <td>: {{ $tenagaKesehatan->user->no_hp ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat</strong></td>
                                        <td>: {{ $tenagaKesehatan->user->alamat ?? '-' }}</td>
                                    </tr>
                                    <tr><td colspan="2"><hr class="my-2"></td></tr>
                                    <tr>
                                        <td><strong>Jenis</strong></td>
                                        <td>: {{ ucfirst($tenagaKesehatan->jenis) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Poli Penugasan</strong></td>
                                        <td>: {{ $tenagaKesehatan->poli->nama_poli ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. STR</strong></td>
                                        <td>: {{ $tenagaKesehatan->no_str ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bergabung</strong></td>
                                        <td>: {{ $tenagaKesehatan->created_at?->format('d/m/Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{-- Riwayat Pemeriksaan --}}
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">
                                    <i class="fas fa-notes-medical mr-1"></i>
                                    Riwayat Pemeriksaan ({{ $tenagaKesehatan->pemeriksaans->count() }} data)
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($tenagaKesehatan->pemeriksaans->isEmpty())
                                    <p class="text-muted text-center my-3">Belum ada riwayat pemeriksaan.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pasien</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tenagaKesehatan->pemeriksaans->take(10) as $i => $pem)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $pem->kunjungan->pasien->nama ?? '-' }}</td>
                                                    <td>{{ $pem->tanggal_pemeriksaan?->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('pemeriksaan.show', $pem) }}"
                                                           class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($tenagaKesehatan->pemeriksaans->count() > 10)
                                        <small class="text-muted">Menampilkan 10 terbaru dari {{ $tenagaKesehatan->pemeriksaans->count() }} total.</small>
                                    @endif
                                @endif
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