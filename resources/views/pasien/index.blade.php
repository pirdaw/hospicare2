<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Pasien — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
    </style>
</head>
<body id="page-top">
<div id="wrapper">

    @include('components.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('components.navbar')

            <div class="container-fluid">

                {{-- Page Heading --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
                    <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-user-plus fa-sm mr-1"></i> Tambah Pasien
                    </a>
                </div>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                {{-- Card Tabel --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Daftar Pasien</h6>

                        {{-- Form Search --}}
                        <form method="GET" action="{{ route('pasien.index') }}" class="d-flex" style="gap:8px">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control form-control-sm"
                                placeholder="Cari nama / NIK / no HP..."
                                style="width:250px"
                            >
                            <button type="submit" class="btn btn-secondary btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="card-body">
                        @if($pasiens->isEmpty())
                            <p class="text-center text-muted my-4">
                                <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                @if(request('search'))
                                    Tidak ada pasien yang cocok dengan pencarian "<strong>{{ request('search') }}</strong>".
                                @else
                                    Belum ada data pasien.
                                @endif
                            </p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Umur</th>
                                            <th>JK</th>
                                            <th>Gol. Darah</th>
                                            <th>No HP</th>
                                            <th width="180" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pasiens as $index => $pasien)
                                        <tr>
                                            <td>{{ $pasiens->firstItem() + $index }}</td>
                                            <td>{{ $pasien->nama }}</td>
                                            <td><code>{{ $pasien->nik }}</code></td>
                                            <td>{{ $pasien->umur }} thn</td>
                                            <td>
                                                @if($pasien->jenis_kelamin === 'L')
                                                    <span class="badge badge-primary"><i class="fas fa-mars mr-1"></i>Laki-laki</span>
                                                @else
                                                    <span class="badge badge-danger"><i class="fas fa-venus mr-1"></i>Perempuan</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $pasien->golongan_darah ?? '-' }}
                                            </td>
                                            <td>{{ $pasien->no_hp }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pasien.show', $pasien) }}"
                                                   class="btn btn-info btn-sm mb-1" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('pasien.edit', $pasien) }}"
                                                   class="btn btn-warning btn-sm mb-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pasien.destroy', $pasien) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin hapus pasien {{ addslashes($pasien->nama) }}? Data kunjungan terkait juga akan terhapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Info + Pagination --}}
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    Menampilkan {{ $pasiens->firstItem() }}–{{ $pasiens->lastItem() }}
                                    dari {{ $pasiens->total() }} pasien
                                    @if(request('search'))
                                        (hasil pencarian "<strong>{{ request('search') }}</strong>")
                                    @endif
                                </small>
                                {{ $pasiens->links() }}
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