<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Kunjungan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .badge-menunggu   { background-color: #f6c23e; color: #333; }
        .badge-diperiksa  { background-color: #36b9cc; color: #fff; }
        .badge-selesai    { background-color: #1cc88a; color: #fff; }
    </style>
</head>
<body id="page-top">
<div id="wrapper">

    @include('components.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('components.navbar')

            <div class="container-fluid">

                {{-- Header --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Kunjungan</h1>
                    <a href="{{ route('kunjungan.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-plus fa-sm mr-1"></i> Tambah Kunjungan
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

                {{-- Filter & Search --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Filter Kunjungan</h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('kunjungan.index') }}">
                            <div class="form-row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Cari nama pasien / NIK..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="tanggal" class="form-control form-control-sm"
                                        value="{{ request('tanggal') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">Semua Status</option>
                                        <option value="menunggu"  {{ request('status') == 'menunggu'  ? 'selected' : '' }}>Menunggu</option>
                                        <option value="diperiksa" {{ request('status') == 'diperiksa' ? 'selected' : '' }}>Diperiksa</option>
                                        <option value="selesai"   {{ request('status') == 'selesai'   ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="poli_id" class="form-control form-control-sm">
                                        <option value="">Semua Poli</option>
                                        @foreach($polis as $poli)
                                            <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>
                                                {{ $poli->nama_poli }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-info btn-sm mr-1">
                                        <i class="fas fa-search mr-1"></i> Cari
                                    </button>
                                    <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Tabel Kunjungan --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold">Daftar Kunjungan</h6>
                        <small class="text-muted">Total: {{ $kunjungans->total() }} data</small>
                    </div>
                    <div class="card-body">
                        @if($kunjungans->isEmpty())
                            <p class="text-center text-muted my-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada data kunjungan.
                            </p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="45px">#</th>
                                            <th>Pasien</th>
                                            <th>Poli</th>
                                            <th>Tanggal</th>
                                            <th>Pembayaran</th>
                                            <th>Status</th>
                                            <th width="180px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kunjungans as $i => $k)
                                        <tr>
                                            <td>{{ $kunjungans->firstItem() + $i }}</td>
                                            <td>
                                                <strong>{{ $k->pasien->nama ?? '-' }}</strong><br>
                                                <small class="text-muted">{{ $k->pasien->nik ?? '' }}</small>
                                            </td>
                                            <td>{{ $k->poli->nama_poli ?? '-' }}</td>
                                            <td>{{ $k->tanggal_kunjungan ? $k->tanggal_kunjungan->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ strtoupper($k->jenis_pembayaran) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($k->status === 'menunggu')
                                                    <span class="badge badge-menunggu px-2 py-1">
                                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                                    </span>
                                                @elseif($k->status === 'diperiksa')
                                                    <span class="badge badge-diperiksa px-2 py-1">
                                                        <i class="fas fa-stethoscope mr-1"></i> Diperiksa
                                                    </span>
                                                @else
                                                    <span class="badge badge-selesai px-2 py-1">
                                                        <i class="fas fa-check mr-1"></i> Selesai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('kunjungan.show', $k) }}"
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('kunjungan.edit', $k) }}"
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(!$k->pemeriksaan)
                                                    <a href="{{ route('pemeriksaan.create', $k) }}"
                                                       class="btn btn-success btn-sm" title="Input SOAP">
                                                        <i class="fas fa-notes-medical"></i>
                                                    </a>
                                                @endif
                                                <form action="{{ route('kunjungan.destroy', $k) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin hapus kunjungan pasien {{ addslashes($k->pasien->nama ?? '') }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    Menampilkan {{ $kunjungans->firstItem() }}–{{ $kunjungans->lastItem() }}
                                    dari {{ $kunjungans->total() }} data
                                </small>
                                {{ $kunjungans->appends(request()->query())->links() }}
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