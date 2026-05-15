<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input Pemeriksaan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .soap-card { border-left: 4px solid #a1bfbc; }
        .soap-label { font-weight: 700; font-size: 15px; }
        .soap-S { border-left-color: #4e73df !important; }
        .soap-O { border-left-color: #1cc88a !important; }
        .soap-A { border-left-color: #f6c23e !important; }
        .soap-P { border-left-color: #e74a3b !important; }
        .vital-card { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px; padding: 12px; }
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
                    <h1 class="h3 mb-0 text-gray-800">Input Pemeriksaan (SOAP)</h1>
                    <a href="{{ route('kunjungan.show', $kunjungan) }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                    </a>
                </div>

                {{-- Info Pasien & Kunjungan --}}
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted d-block">PASIEN</small>
                                <strong>{{ $kunjungan->pasien->nama ?? '-' }}</strong>
                                <span class="text-muted ml-2">{{ $kunjungan->pasien->nik ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block">POLI</small>
                                <strong>{{ $kunjungan->poli->nama_poli ?? '-' }}</strong>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block">TANGGAL KUNJUNGAN</small>
                                <strong>{{ $kunjungan->tanggal_kunjungan?->format('d/m/Y') }}</strong>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted d-block">KELUHAN</small>
                                <strong>{{ Str::limit($kunjungan->keluhan, 40) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
                    <input type="hidden" name="poli_id" value="{{ $kunjungan->poli_id }}">

                    {{-- Pilih Tenaga Kesehatan --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-user-md mr-1"></i> Pemeriksa</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tenaga Kesehatan <span class="text-danger">*</span></label>
                                        <select name="tenaga_kesehatan_id"
                                            class="form-control @error('tenaga_kesehatan_id') is-invalid @enderror">
                                            <option value="">-- Pilih Pemeriksa --</option>
                                            @foreach($tenagaKesehatans as $nakes)
                                                <option value="{{ $nakes->id }}"
                                                    {{ old('tenaga_kesehatan_id') == $nakes->id ? 'selected' : '' }}
                                                    {{ (auth()->user()->tenagaKesehatan?->id == $nakes->id) ? 'selected' : '' }}>
                                                    {{ $nakes->user->nama ?? '-' }}
                                                    ({{ ucfirst($nakes->jenis) }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tenaga_kesehatan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal & Jam Pemeriksaan <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="tanggal_pemeriksaan"
                                            class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                                            value="{{ old('tanggal_pemeriksaan', now()->format('Y-m-d\TH:i')) }}">
                                        @error('tanggal_pemeriksaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tanda Vital --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-heartbeat mr-1 text-danger"></i> Tanda Vital
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-danger font-weight-bold">
                                            <i class="fas fa-thermometer-half mr-1"></i> Suhu (°C)
                                        </label>
                                        <input type="number" name="suhu" step="0.1" min="30" max="45"
                                            class="form-control @error('suhu') is-invalid @enderror"
                                            value="{{ old('suhu') }}" placeholder="36.5">
                                        @error('suhu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-warning font-weight-bold">
                                            <i class="fas fa-tint mr-1"></i> Tensi (mmHg)
                                        </label>
                                        <input type="text" name="tensi"
                                            class="form-control @error('tensi') is-invalid @enderror"
                                            value="{{ old('tensi') }}" placeholder="120/80">
                                        @error('tensi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-info font-weight-bold">
                                            <i class="fas fa-heart mr-1"></i> Nadi (x/mnt)
                                        </label>
                                        <input type="number" name="nadi" min="0" max="300"
                                            class="form-control @error('nadi') is-invalid @enderror"
                                            value="{{ old('nadi') }}" placeholder="80">
                                        @error('nadi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-success font-weight-bold">
                                            <i class="fas fa-lungs mr-1"></i> Respirasi (x/mnt)
                                        </label>
                                        <input type="number" name="respirasi" min="0" max="100"
                                            class="form-control @error('respirasi') is-invalid @enderror"
                                            value="{{ old('respirasi') }}" placeholder="20">
                                        @error('respirasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SOAP --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-notes-medical mr-1"></i> Catatan SOAP
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- S --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-S p-3">
                                        <label class="soap-label text-primary">
                                            S — <span class="font-weight-normal">Subjective</span>
                                        </label>
                                        <small class="text-muted mb-2 d-block">
                                            Keluhan yang dirasakan pasien (anamnesis)
                                        </small>
                                        <textarea name="subjective" rows="4"
                                            class="form-control @error('subjective') is-invalid @enderror"
                                            placeholder="Pasien mengeluh...">{{ old('subjective', $kunjungan->keluhan) }}</textarea>
                                        @error('subjective')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- O --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-O p-3">
                                        <label class="soap-label text-success">
                                            O — <span class="font-weight-normal">Objective</span>
                                        </label>
                                        <small class="text-muted mb-2 d-block">
                                            Hasil pemeriksaan fisik & penunjang
                                        </small>
                                        <textarea name="objective" rows="4"
                                            class="form-control @error('objective') is-invalid @enderror"
                                            placeholder="Pemeriksaan fisik menunjukkan...">{{ old('objective') }}</textarea>
                                        @error('objective')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- A --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-A p-3">
                                        <label class="soap-label text-warning">
                                            A — <span class="font-weight-normal">Assessment</span>
                                        </label>
                                        <small class="text-muted mb-2 d-block">
                                            Diagnosis / penilaian klinis
                                        </small>
                                        <textarea name="assessment" rows="4"
                                            class="form-control @error('assessment') is-invalid @enderror"
                                            placeholder="Diagnosis: ...">{{ old('assessment') }}</textarea>
                                        @error('assessment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- P --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-P p-3">
                                        <label class="soap-label text-danger">
                                            P — <span class="font-weight-normal">Plan</span>
                                        </label>
                                        <small class="text-muted mb-2 d-block">
                                            Rencana tindakan / pengobatan
                                        </small>
                                        <textarea name="plan" rows="4"
                                            class="form-control @error('plan') is-invalid @enderror"
                                            placeholder="Tindakan: ...&#10;Obat: ...&#10;Anjuran: ...">{{ old('plan') }}</textarea>
                                        @error('plan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('kunjungan.show', $kunjungan) }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Pemeriksaan
                        </button>
                    </div>

                </form>

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