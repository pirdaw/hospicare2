<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Tenaga Kesehatan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Tenaga Kesehatan</h1>
                    <a href="{{ route('tenaga-kesehatan.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-plus fa-sm mr-1"></i> Tambah Tenaga Kesehatan
                    </a>
                </div>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                {{-- Search & Filter --}}
                <div class="card shadow mb-3">
                    <div class="card-body py-3">
                        <form method="GET" action="{{ route('tenaga-kesehatan.index') }}">
                            <div class="form-row">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Cari nama / email..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="jenis" class="form-control form-control-sm">
                                        <option value="">Semua Jenis</option>
                                        <option value="dokter"   {{ request('jenis') === 'dokter'   ? 'selected' : '' }}>Dokter</option>
                                        <option value="perawat"  {{ request('jenis') === 'perawat'  ? 'selected' : '' }}>Perawat</option>
                                        <option value="bidan"    {{ request('jenis') === 'bidan'    ? 'selected' : '' }}>Bidan</option>
                                        <option value="lainnya"  {{ request('jenis') === 'lainnya'  ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="poli_id" class="form-control form-control-sm">
                                        <option value="">Semua Poli</option>
                                        @foreach($polis as $poli)
                                            <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>
                                                {{ $poli->nama_poli }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-info btn-sm mr-1">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="{{ route('tenaga-kesehatan.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Tabel --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold">Daftar Tenaga Kesehatan</h6>
                        <small class="text-muted">Total: {{ $tenagaKesehatans->total() }} data</small>
                    </div>
                    <div class="card-body">
                        @if($tenagaKesehatans->isEmpty())
                            <p class="text-center text-muted my-4">
                                <i class="fas fa-user-md fa-2x mb-2 d-block"></i>
                                Belum ada data tenaga kesehatan.
                            </p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="45px">#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jenis</th>
                                            <th>Poli</th>
                                            <th>No. STR</th>
                                            <th width="160px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tenagaKesehatans as $i => $nakes)
                                        <tr>
                                            <td>{{ $tenagaKesehatans->firstItem() + $i }}</td>
                                            <td>
                                                <strong>{{ $nakes->user->nama ?? '-' }}</strong>
                                                <br><small class="text-muted">{{ $nakes->user->no_hp ?? '' }}</small>
                                            </td>
                                            <td>{{ $nakes->user->email ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $jenisLabel = [
                                                        'dokter'  => ['label' => 'Dokter',  'class' => 'badge-primary'],
                                                        'perawat' => ['label' => 'Perawat', 'class' => 'badge-info'],
                                                        'bidan'   => ['label' => 'Bidan',   'class' => 'badge-warning'],
                                                        'lainnya' => ['label' => 'Lainnya', 'class' => 'badge-secondary'],
                                                    ];
                                                    $j = $jenisLabel[$nakes->jenis] ?? ['label' => $nakes->jenis, 'class' => 'badge-light'];
                                                @endphp
                                                <span class="badge {{ $j['class'] }}">{{ $j['label'] }}</span>
                                            </td>
                                            <td>{{ $nakes->poli->nama_poli ?? '<span class="text-muted">-</span>' }}</td>
                                            <td>{{ $nakes->no_str ?? '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('tenaga-kesehatan.show', $nakes) }}"
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tenaga-kesehatan.edit', $nakes) }}"
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tenaga-kesehatan.destroy', $nakes) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin hapus akun {{ addslashes($nakes->user->nama ?? '') }}? Akun login juga akan terhapus.')">
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

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    Menampilkan {{ $tenagaKesehatans->firstItem() }}–{{ $tenagaKesehatans->lastItem() }}
                                    dari {{ $tenagaKesehatans->total() }} data
                                </small>
                                {{ $tenagaKesehatans->appends(request()->query())->links() }}
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