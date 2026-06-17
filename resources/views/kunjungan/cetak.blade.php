<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Kunjungan — Hospicare</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; padding: 24px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.sub { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
        .btn-print { margin-bottom: 16px; padding: 8px 16px; cursor: pointer; }
        @media print { .btn-print { display: none; } }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>

    <h2>Laporan Data Kunjungan</h2>
    <p class="sub">Hospicare — Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pasien</th>
                <th>NIK</th>
                <th>Poli</th>
                <th>Tanggal</th>
                <th>Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjungans as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->pasien->nama ?? '-' }}</td>
                    <td>{{ $k->pasien->nik ?? '-' }}</td>
                    <td>{{ $k->poli->nama_poli ?? '-' }}</td>
                    <td>{{ $k->tanggal_kunjungan ? $k->tanggal_kunjungan->format('d/m/Y') : '-' }}</td>
                    <td>{{ strtoupper($k->jenis_pembayaran) }}</td>
                    <td>{{ ucfirst($k->status) }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>