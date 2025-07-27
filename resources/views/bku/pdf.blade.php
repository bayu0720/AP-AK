<!-- filepath: resources/views/bku/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Buku Kas Umum</title>
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
    <h3 class="text-center">BUKU KAS UMUM</h3>
    <p class="text-center">Periode: {{ $periode ?? 'tanggal bulan s.d. tanggal bulan tahun' }}</p>
    <table class="no-border">
        <tr><td>Nama SPPG</td><td>: {{ $nama_sppg ?? '' }}</td></tr>
        <tr><td>Kelurahan/Desa</td><td>: {{ $kelurahan ?? '' }}</td></tr>
        <tr><td>Kecamatan</td><td>: {{ $kecamatan ?? '' }}</td></tr>
        <tr><td>Kabupaten/Kota</td><td>: {{ $kabupaten ?? '' }}</td></tr>
        <tr><td>Provinsi</td><td>: {{ $provinsi ?? '' }}</td></tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No. Bukti</th>
                <th>Uraian</th>
                <th>Pemasukan (Debet)</th>
                <th>Pengeluaran (Kredit)</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $saldo = $saldo_awal ?? 0;
                $no = 1;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tanggal_awal ?? '' }}</td>
                <td></td>
                <td>Saldo Awal</td>
                <td></td>
                <td></td>
                <td>{{ number_format($saldo, 2) }}</td>
            </tr>
            @foreach($bku as $item)
            @php
                $debet = $item->type == 'Pemasukan' ? $item->amount : 0;
                $kredit = $item->type == 'Pengeluaran' ? $item->amount : 0;
                $saldo += $debet - $kredit;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->no_bukti ?? '' }}</td>
                <td>{{ $item->description }}</td>
                <td class="text-right">{{ $debet ? number_format($debet, 2) : '' }}</td>
                <td class="text-right">{{ $kredit ? number_format($kredit, 2) : '' }}</td>
                <td class="text-right">{{ number_format($saldo, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><b>Total</b></td>
                <td class="text-right"><b>{{ number_format($total_pemasukan, 2) }}</b></td>
                <td class="text-right"><b>{{ number_format($total_pengeluaran, 2) }}</b></td>
                <td class="text-right"><b>{{ number_format($saldo_akhir, 2) }}</b></td>
            </tr>
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
    <b>Catatan Penting:</b>
    <ol>
        <li>Seluruh transaksi uang keluar dan masuk wajib dicatat pada BKU.</li>
        <li>Pencatatan secara tertib dengan mengikuti kronologis waktu/kejadian transaksi dan secara harian.</li>
        <li>Periode adalah periode operasional dapur SPPG selama 2 pekan/minggu.</li>
    </ol>
</body>
</html>