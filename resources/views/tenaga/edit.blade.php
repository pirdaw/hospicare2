<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Tenaga Kesehatan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .section-title { font-size: 13px; font-weight: 600; color: #5a6268;
                         text-transform: uppercase; letter-spacing: 0.5px;
                         border-bottom: 2px solid #a1bfbc; padding-bottom: 6px; margin-bottom: 16px; }
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Tenaga Kesehatan</h1>
                    <a href="{{ route('tenaga-kesehatan.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Form Edit Tenaga Kesehatan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tenaga-kesehatan.update', $tenagaKesehatan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Data Pribadi --}}
                            <div class="section-title"><i class="fas fa-user-circle mr-1"></i> Data Pribadi</div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $tenagaKesehatan->user->nama) }}" autofocus>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <small class="text-muted">(tidak bisa diubah)</small></label>
                                        <input type="email" class="form-control bg-light"
                                            value="{{ $tenagaKesehatan->user->email }}" disabled>
                                        <small class="text-muted">Hubungi admin untuk mengubah email.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input type="text" name="no_hp"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp', $tenagaKesehatan->user->no_hp) }}"
                                            placeholder="08xxxxxxxxxx">
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror"
                                            value="{{ old('alamat', $tenagaKesehatan->user->alamat) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Data Medis --}}
                            <div class="section-title"><i class="fas fa-stethoscope mr-1"></i> Data Profil Medis</div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Tenaga Kesehatan <span class="text-danger">*</span></label>
                                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                            <option value="dokter"  {{ old('jenis', $tenagaKesehatan->jenis) === 'dokter'  ? 'selected' : '' }}>Dokter</option>
                                            <option value="perawat" {{ old('jenis', $tenagaKesehatan->jenis) === 'perawat' ? 'selected' : '' }}>Perawat</option>
                                            <option value="bidan"   {{ old('jenis', $tenagaKesehatan->jenis) === 'bidan'   ? 'selected' : '' }}>Bidan</option>
                                            <option value="lainnya" {{ old('jenis', $tenagaKesehatan->jenis) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Penugasan Poli</label>
                                        <select name="poli_id" class="form-control @error('poli_id') is-invalid @enderror">
                                            <option value="">-- Tanpa Poli --</option>
                                            @foreach($polis as $poli)
                                                <option value="{{ $poli->id }}"
                                                    {{ old('poli_id', $tenagaKesehatan->poli_id) == $poli->id ? 'selected' : '' }}>
                                                    {{ $poli->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('poli_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No. STR</label>
                                        <input type="text" name="no_str"
                                            class="form-control @error('no_str') is-invalid @enderror"
                                            value="{{ old('no_str', $tenagaKesehatan->no_str) }}"
                                            placeholder="Nomor STR">
                                        @error('no_str')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('tenaga-kesehatan.index') }}" class="btn btn-secondary mr-2">Batal</a>
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