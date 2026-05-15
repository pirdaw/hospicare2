<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Poli — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar { background-color: #778d8d !important; }
        .topbar  { background-color: #f7cbca !important; }
        .card-header { background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary { background-color: #f7cbca !important; border-color: #f7cbca !important; }
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

                {{-- Header halaman --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Poli</h1>
                    <a href="{{ route('poli.create') }}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Poli
                    </a>
                </div>

                {{-- Notifikasi sukses / error --}}
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

                {{-- Tabel Poli --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Daftar Poli</h6>
                    </div>
                    <div class="card-body">
                        @if($polis->isEmpty())
                            <p class="text-center text-muted my-4">
                                <i class="fas fa-hospital fa-2x mb-2 d-block"></i>
                                Belum ada data poli. Silakan tambah poli terlebih dahulu.
                            </p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="60px">#</th>
                                            <th>Nama Poli</th>
                                            <th width="180px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($polis as $index => $poli)
                                        <tr>
                                            <td>{{ $polis->firstItem() + $index }}</td>
                                            <td>{{ $poli->nama_poli }}</td>
                                            <td class="text-center">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('poli.edit', $poli) }}"
                                                   class="btn btn-warning btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('poli.destroy', $poli) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin hapus poli {{ $poli->nama_poli }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-end mt-3">
                                {{ $polis->links() }}
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
