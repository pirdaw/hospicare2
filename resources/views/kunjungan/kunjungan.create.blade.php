<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Kunjungan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        #pasien-info { background: #f0f4f4; border-left: 4px solid #a1bfbc; }
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
                    <h1 class="h3 mb-0 text-gray-800">Daftarkan Kunjungan</h1>
                    <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                    </a>
                </div>

                {{-- LANGKAH 1: Cari Pasien --}}
                @if(!$pasien)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-search mr-1"></i> Cari Pasien Berdasarkan NIK
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pasien.cari') }}">
                            @csrf
                            <div class="form-row align-items-end">
                                <div class="col-md-6">
                                    <label>NIK Pasien</label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="Masukkan 16 digit NIK" maxlength="16"
                                        value="{{ old('nik') }}" autofocus>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search mr-1"></i> Cari Pasien
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if(session('error'))
                            <div class="alert alert-danger mt-3 mb-0">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                                <br><small>Pastikan pasien sudah terdaftar, atau <a href="{{ route('pasien.create') }}">daftar pasien baru</a>.</small>
                            </div>
                        @endif

                        <hr>
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle mr-1"></i>
                            Pasien belum terdaftar?
                            <a href="{{ route('pasien.create') }}">Tambah Pasien Baru</a>
                        </p>
                    </div>
                </div>

                {{-- LANGKAH 2: Formulir Kunjungan (tampil setelah pasien ditemukan) --}}
                @else
                {{-- Info Pasien Ditemukan --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-user-check mr-1 text-success"></i> Pasien Ditemukan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="pasien-info" class="p-3 rounded mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="130"><strong>Nama</strong></td>
                                            <td>: {{ $pasien->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIK</strong></td>
                                            <td>: {{ $pasien->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin</strong></td>
                                            <td>: {{ $pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="130"><strong>Umur</strong></td>
                                            <td>: {{ $pasien->umur }} tahun</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gol. Darah</strong></td>
                                            <td>: {{ $pasien->golongan_darah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. HP</strong></td>
                                            <td>: {{ $pasien->no_hp ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Form Kunjungan --}}
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Poli <span class="text-danger">*</span></label>
                                        <select name="poli_id" class="form-control @error('poli_id') is-invalid @enderror">
                                            <option value="">-- Pilih Poli --</option>
                                            @foreach($polis as $poli)
                                                <option value="{{ $poli->id }}" {{ old('poli_id') == $poli->id ? 'selected' : '' }}>
                                                    {{ $poli->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('poli_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kunjungan <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_kunjungan"
                                            class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                                            value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}">
                                        @error('tanggal_kunjungan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keluhan <span class="text-danger">*</span></label>
                                <textarea name="keluhan" rows="3"
                                    class="form-control @error('keluhan') is-invalid @enderror"
                                    placeholder="Tulis keluhan pasien...">{{ old('keluhan') }}</textarea>
                                @error('keluhan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <select name="jenis_pembayaran" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="umum"   {{ old('jenis_pembayaran') === 'umum'   ? 'selected' : '' }}>Umum</option>
                                            <option value="bpjs"   {{ old('jenis_pembayaran') === 'bpjs'   ? 'selected' : '' }}>BPJS</option>
                                            <option value="swasta" {{ old('jenis_pembayaran') === 'swasta' ? 'selected' : '' }}>Swasta / Asuransi</option>
                                        </select>
                                        @error('jenis_pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rujukan Dari <small class="text-muted">(opsional)</small></label>
                                        <input type="text" name="rujukan_dari"
                                            class="form-control @error('rujukan_dari') is-invalid @enderror"
                                            placeholder="Contoh: Puskesmas Xxx"
                                            value="{{ old('rujukan_dari') }}">
                                        @error('rujukan_dari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="menunggu" {{ old('status', 'menunggu') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diperiksa" {{ old('status') === 'diperiksa' ? 'selected' : '' }}>Diperiksa</option>
                                    <option value="selesai"   {{ old('status') === 'selesai'   ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Daftarkan Kunjungan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

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