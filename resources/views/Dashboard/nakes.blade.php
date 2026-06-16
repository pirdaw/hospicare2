<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Nakes — Hospicare</title>
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
                        <div>
                            <h1 class="h3 mb-0 text-gray-800">Antrian Pemeriksaan</h1>
                            @if($nakes)
                                <small class="text-muted">
                                    {{ ucfirst($nakes->jenis) }} — Poli {{ $nakes->poli->nama_poli ?? 'Umum' }}
                                </small>
                            @endif
                        </div>
                        <span class="badge badge-success" style="font-size:14px; padding:8px 16px;">
                            Sudah diperiksa hari ini: {{ $sudah_diperiksa }}
                        </span>
                    </div>

                    @if($antrian->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-check-circle mr-2"></i>
                            Tidak ada antrian pasien saat ini. Semua pasien sudah ditangani.
                        </div>
                    @else
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Pasien Menunggu Pemeriksaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light text-center">
                                            <tr>
                                                <th>Antrian</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>Keluhan</th>
                                                <th>Pembayaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($antrian as $i => $k)
                                                <tr class="{{ $i === 0 ? 'table-warning font-weight-bold' : '' }}">
                                                    <td class="text-center">
                                                        @if($i === 0)
                                                            <span class="badge badge-warning"
                                                                style="font-size:14px;">Sekarang</span>
                                                        @else
                                                            {{ $i + 1 }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $k->pasien->nama ?? '-' }}</td>
                                                    <td class="text-center">{{ $k->pasien->umur ?? '-' }} th</td>
                                                    <td>{{ Str::limit($k->keluhan, 50) }}</td>
                                                    <td class="text-center">{{ $k->jenis_pembayaran }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pemeriksaan.create', $k) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fas fa-stethoscope"></i> Periksa
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

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