{{-- resources/views/pasien/pasien.show.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pasien — Hospicare</title>
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

        .btn-primary {
            background-color: #f7cbca !important;
            border-color: #f7cbca !important;
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Pasien</h1>
                        <div style="gap:8px" class="d-flex">
                            <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Informasi Pasien</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Nama</th>
                                    <td>{{ $pasien->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td><code>{{ $pasien->nik }}</code></td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $pasien->umur }} tahun</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Golongan Darah</th>
                                    <td>{{ $pasien->golongan_darah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $pasien->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>{{ $pasien->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>{{ $pasien->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $pasien->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Terdaftar</th>
                                    <td>{{ $pasien->created_at->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Riwayat Kunjungan --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Riwayat Kunjungan</h6>
                        </div>
                        <div class="card-body">
                            @if($pasien->kunjungans->isEmpty())
                                <p class="text-center text-muted">Belum ada riwayat kunjungan.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Poli</th>
                                                <th>Keluhan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pasien->kunjungans as $i => $k)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $k->tanggal_kunjungan->format('d M Y') }}</td>
                                                    <td>{{ $k->poli->nama_poli ?? '-' }}</td>
                                                    <td>{{ Str::limit($k->keluhan, 50) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $k->status === 'selesai' ? 'success' : ($k->status === 'diperiksa' ? 'info' : 'warning') }}">
                                                            {{ ucfirst($k->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('kunjungan.show', $k) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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