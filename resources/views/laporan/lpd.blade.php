<!-- filepath: resources/views/laporan/lpd.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggunaan Dana</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
        th { background: #eee; }
        .no-border td { border: none; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h3 class="text-center">LAPORAN PENGGUNAAN DANA</h3>
    <h4 class="text-center">REKAPITULASI BULANAN</h4>
    <table class="no-border">
        <tr><td>Nama SPPG</td><td>: {{ $nama_sppg ?? '........................................' }}</td></tr>
        <tr><td>Kelurahan/Desa</td><td>: {{ $kelurahan ?? '........................................' }}</td></tr>
        <tr><td>Kecamatan</td><td>: {{ $kecamatan ?? '........................................' }}</td></tr>
        <tr><td>Kabupaten/Kota</td><td>: {{ $kabupaten ?? '........................................' }}</td></tr>
        <tr><td>Provinsi</td><td>: {{ $provinsi ?? '........................................' }}</td></tr>
        <tr><td>Periode</td><td>: {{ $periode ?? '........................................' }}</td></tr>
    </table>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Saldo Awal</th>
                <th rowspan="2">Penerimaan Dana</th>
                <th colspan="3" class="text-center">Pengeluaran Dana</th>
                <th rowspan="2">TOTAL Pengeluaran</th>
                <th rowspan="2">Saldo Akhir</th>
            </tr>
            <tr>
                <th>Bahan Pangan</th>
                <th>Operasional</th>
                <th>Sewa</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                // Contoh data, ganti dengan data dari controller
                $saldo_awal = $saldo_awal ?? 0;
                $penerimaan = $penerimaan ?? 0;
                $bahan_pangan = $bahan_pangan ?? 0;
                $operasional = $operasional ?? 0;
                $sewa = $sewa ?? 0;
                $total_pengeluaran = $bahan_pangan + $operasional + $sewa;
                $saldo_akhir = $saldo_awal + $penerimaan - $total_pengeluaran;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-right">{{ number_format($saldo_awal, 2) }}</td>
                <td class="text-right">{{ number_format($penerimaan, 2) }}</td>
                <td class="text-right">{{ number_format($bahan_pangan, 2) }}</td>
                <td class="text-right">{{ number_format($operasional, 2) }}</td>
                <td class="text-right">{{ number_format($sewa, 2) }}</td>
                <td class="text-right">{{ number_format($total_pengeluaran, 2) }}</td>
                <td class="text-right">{{ number_format($saldo_akhir, 2) }}</td>
            </tr>
            <!-- Tambahkan baris periode berikutnya jika ada -->
        </tbody>
    </table>
    <br>
    <table class="no-border">
        <tr>
            <td width="50%">
                Mengetahui,<br>
                Kepala SPPG,<br><br><br><br>
                (...................................)
            </td>
            <td width="50%" class="text-right">
                ................, .......................... 20.....<br>
                Akuntan SPPG,<br><br><br><br>
                (...................................)
            </td>
        </tr>
    </table>
    <br>
    <b>Keterangan:</b>
    <ol>
        <li>Saldo Awal (kolom 2) untuk pertama kali operasional diisi dengan angka 0. Pada periode selanjutnya Saldo Awal merupakan Saldo Akhir periode operasional sebelumnya.</li>
        <li>Penerimaan Dana (kolom 3) diisi dengan akumulasi seluruh penerimaan dana baik dana talangan, pencairan dari BGN, dsb.</li>
        <li>Pengeluaran Dana diisi dengan akumulasi masing-masing jenis pengeluaran dana.</li>
        <li>LPD merupakan laporan periodik yang dibuat pada akhir bulan (disesuaikan dengan periodisasinya).</li>
    </ol>
</body>
</html>