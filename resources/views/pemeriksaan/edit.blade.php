<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pemeriksaan — Hospicare</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .sidebar    { background-color: #778d8d !important; }
        .topbar     { background-color: #f7cbca !important; }
        .card-header{ background-color: #a1bfbc !important; color: #4F6F6F; }
        .btn-primary{ background-color: #f7cbca !important; border-color: #f7cbca !important; color: #333 !important; }
        .btn-primary:hover { background-color: #f3b6cf !important; border-color: #f3b6cf !important; }
        .soap-card { border-left: 4px solid #a1bfbc; }
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Pemeriksaan</h1>
                    <a href="{{ route('pemeriksaan.show', $pemeriksaan) }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                    </a>
                </div>

                {{-- Info Pasien --}}
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted d-block">PASIEN</small>
                                <strong>{{ $pemeriksaan->kunjungan->pasien->nama ?? '-' }}</strong>
                                <span class="text-muted ml-2">{{ $pemeriksaan->kunjungan->pasien->nik ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block">POLI</small>
                                <strong>{{ $pemeriksaan->kunjungan->poli->nama_poli ?? '-' }}</strong>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block">TANGGAL KUNJUNGAN</small>
                                <strong>{{ $pemeriksaan->kunjungan->tanggal_kunjungan?->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('pemeriksaan.update', $pemeriksaan) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                        <label class="text-danger font-weight-bold">Suhu (°C)</label>
                                        <input type="number" name="suhu" step="0.1" min="30" max="45"
                                            class="form-control @error('suhu') is-invalid @enderror"
                                            value="{{ old('suhu', $pemeriksaan->suhu) }}" placeholder="36.5">
                                        @error('suhu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-warning font-weight-bold">Tensi (mmHg)</label>
                                        <input type="text" name="tensi"
                                            class="form-control @error('tensi') is-invalid @enderror"
                                            value="{{ old('tensi', $pemeriksaan->tensi) }}" placeholder="120/80">
                                        @error('tensi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-info font-weight-bold">Nadi (x/mnt)</label>
                                        <input type="number" name="nadi" min="0" max="300"
                                            class="form-control @error('nadi') is-invalid @enderror"
                                            value="{{ old('nadi', $pemeriksaan->nadi) }}" placeholder="80">
                                        @error('nadi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="vital-card mb-3">
                                        <label class="text-success font-weight-bold">Respirasi (x/mnt)</label>
                                        <input type="number" name="respirasi" min="0" max="100"
                                            class="form-control @error('respirasi') is-invalid @enderror"
                                            value="{{ old('respirasi', $pemeriksaan->respirasi) }}" placeholder="20">
                                        @error('respirasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-S p-3">
                                        <label class="font-weight-bold text-primary">S — Subjective</label>
                                        <textarea name="subjective" rows="4"
                                            class="form-control @error('subjective') is-invalid @enderror"
                                            placeholder="Keluhan pasien...">{{ old('subjective', $pemeriksaan->subjective) }}</textarea>
                                        @error('subjective') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-O p-3">
                                        <label class="font-weight-bold text-success">O — Objective</label>
                                        <textarea name="objective" rows="4"
                                            class="form-control @error('objective') is-invalid @enderror"
                                            placeholder="Hasil pemeriksaan fisik...">{{ old('objective', $pemeriksaan->objective) }}</textarea>
                                        @error('objective') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-A p-3">
                                        <label class="font-weight-bold text-warning">A — Assessment</label>
                                        <textarea name="assessment" rows="4"
                                            class="form-control @error('assessment') is-invalid @enderror"
                                            placeholder="Diagnosis...">{{ old('assessment', $pemeriksaan->assessment) }}</textarea>
                                        @error('assessment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card soap-card soap-P p-3">
                                        <label class="font-weight-bold text-danger">P — Plan</label>
                                        <textarea name="plan" rows="4"
                                            class="form-control @error('plan') is-invalid @enderror"
                                            placeholder="Rencana tindakan...">{{ old('plan', $pemeriksaan->plan) }}</textarea>
                                        @error('plan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal & Jam Pemeriksaan <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="tanggal_pemeriksaan"
                                    class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                                    style="max-width: 300px;"
                                    value="{{ old('tanggal_pemeriksaan', $pemeriksaan->tanggal_pemeriksaan?->format('Y-m-d\TH:i')) }}">
                                @error('tanggal_pemeriksaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('pemeriksaan.show', $pemeriksaan) }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
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