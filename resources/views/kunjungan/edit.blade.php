<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Kunjungan — Hospicare</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .pasien-badge { background: #f0f4f4; border-left: 4px solid #a1bfbc; }
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Kunjungan</h1>
                    <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Form Edit Kunjungan</h6>
                    </div>
                    <div class="card-body">

                        {{-- Info Pasien (read-only) --}}
                        <div class="pasien-badge p-3 rounded mb-4">
                            <strong><i class="fas fa-user mr-1"></i> Pasien:</strong>
                            {{ $kunjungan->pasien->nama ?? '-' }}
                            <span class="text-muted ml-2">(NIK: {{ $kunjungan->pasien->nik ?? '-' }})</span>
                        </div>

                        <form action="{{ route('kunjungan.update', $kunjungan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Poli <span class="text-danger">*</span></label>
                                        <select name="poli_id" class="form-control @error('poli_id') is-invalid @enderror">
                                            <option value="">-- Pilih Poli --</option>
                                            @foreach($polis as $poli)
                                                <option value="{{ $poli->id }}"
                                                    {{ old('poli_id', $kunjungan->poli_id) == $poli->id ? 'selected' : '' }}>
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
                                            value="{{ old('tanggal_kunjungan', $kunjungan->tanggal_kunjungan?->format('Y-m-d')) }}">
                                        @error('tanggal_kunjungan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keluhan <span class="text-danger">*</span></label>
                                <textarea name="keluhan" rows="3"
                                    class="form-control @error('keluhan') is-invalid @enderror">{{ old('keluhan', $kunjungan->keluhan) }}</textarea>
                                @error('keluhan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <select name="jenis_pembayaran" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                                            <option value="umum"   {{ old('jenis_pembayaran', $kunjungan->jenis_pembayaran) === 'umum'   ? 'selected' : '' }}>Umum</option>
                                            <option value="bpjs"   {{ old('jenis_pembayaran', $kunjungan->jenis_pembayaran) === 'bpjs'   ? 'selected' : '' }}>BPJS</option>
                                            <option value="swasta" {{ old('jenis_pembayaran', $kunjungan->jenis_pembayaran) === 'swasta' ? 'selected' : '' }}>Swasta / Asuransi</option>
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
                                            value="{{ old('rujukan_dari', $kunjungan->rujukan_dari) }}"
                                            placeholder="Contoh: Puskesmas Xxx">
                                        @error('rujukan_dari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="menunggu"  {{ old('status', $kunjungan->status) === 'menunggu'  ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diperiksa" {{ old('status', $kunjungan->status) === 'diperiksa' ? 'selected' : '' }}>Diperiksa</option>
                                    <option value="selesai"   {{ old('status', $kunjungan->status) === 'selesai'   ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
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