{{-- Nama --}}
<div class="form-group">
    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
    <input
        type="text"
        name="nama"
        id="nama"
        class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $pasien->nama ?? '') }}"
        placeholder="Masukkan nama lengkap"
        autofocus
    >
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- NIK --}}
<div class="form-group">
    <label for="nik">NIK (16 digit) <span class="text-danger">*</span></label>
    <input
        type="text"
        name="nik"
        id="nik"
        class="form-control @error('nik') is-invalid @enderror"
        value="{{ old('nik', $pasien->nik ?? '') }}"
        placeholder="Masukkan 16 digit NIK"
        maxlength="16"
        inputmode="numeric"
    >
    @error('nik')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Umur + Jenis Kelamin --}}
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="umur">Umur <span class="text-danger">*</span></label>
        <div class="input-group">
            <input
                type="number"
                name="umur"
                id="umur"
                class="form-control @error('umur') is-invalid @enderror"
                value="{{ old('umur', $pasien->umur ?? '') }}"
                min="0" max="150"
                placeholder="0"
            >
            <div class="input-group-append">
                <span class="input-group-text">tahun</span>
            </div>
            @error('umur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
        <select name="jenis_kelamin" id="jenis_kelamin"
                class="form-control @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
        @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="golongan_darah">Golongan Darah</label>
        <select name="golongan_darah" id="golongan_darah"
                class="form-control @error('golongan_darah') is-invalid @enderror">
            <option value="">-- Tidak diketahui --</option>
            @foreach(['A','B','AB','O'] as $gd)
                <option value="{{ $gd }}"
                    {{ old('golongan_darah', $pasien->golongan_darah ?? '') === $gd ? 'selected' : '' }}>
                    {{ $gd }}
                </option>
            @endforeach
        </select>
        @error('golongan_darah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Agama + Pekerjaan --}}
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="agama">Agama <span class="text-danger">*</span></label>
        <select name="agama" id="agama"
                class="form-control @error('agama') is-invalid @enderror">
            <option value="">-- Pilih Agama --</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                <option value="{{ $agama }}"
                    {{ old('agama', $pasien->agama ?? '') === $agama ? 'selected' : '' }}>
                    {{ $agama }}
                </option>
            @endforeach
        </select>
        @error('agama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
        <input
            type="text"
            name="pekerjaan"
            id="pekerjaan"
            class="form-control @error('pekerjaan') is-invalid @enderror"
            value="{{ old('pekerjaan', $pasien->pekerjaan ?? '') }}"
            placeholder="Contoh: Pegawai Swasta"
        >
        @error('pekerjaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- No HP --}}
<div class="form-group">
    <label for="no_hp">Nomor HP <span class="text-danger">*</span></label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        <input
            type="text"
            name="no_hp"
            id="no_hp"
            class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $pasien->no_hp ?? '') }}"
            placeholder="Contoh: 08123456789"
            maxlength="20"
            inputmode="tel"
        >
        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Alamat --}}
<div class="form-group">
    <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
    <textarea
        name="alamat"
        id="alamat"
        rows="3"
        class="form-control @error('alamat') is-invalid @enderror"
        placeholder="Masukkan alamat lengkap"
    >{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>