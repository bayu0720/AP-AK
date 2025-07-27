<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class LPDController extends Controller
{
    public function index()
    {
        // Contoh data, bisa diganti ambil dari database
        $nama_sppg = 'SPPG Contoh';
        $kelurahan = 'Kelurahan Contoh';
        $kecamatan = 'Kecamatan Contoh';
        $kabupaten = 'Kabupaten Contoh';
        $provinsi = 'Provinsi Contoh';
        $periode = 'Juli 2025';

        // Data keuangan, bisa diambil dari model
        $saldo_awal = 1000000;
        $penerimaan = 6000000;
        $bahan_pangan = 3000000;
        $operasional = 2000000;
        $sewa = 500000;
        $total_pengeluaran = $bahan_pangan + $operasional + $sewa;
        $saldo_akhir = $saldo_awal + $penerimaan - $total_pengeluaran;

        return view('laporan.index', compact(
            'nama_sppg', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'periode',
            'saldo_awal', 'penerimaan', 'bahan_pangan', 'operasional', 'sewa',
            'total_pengeluaran', 'saldo_akhir'
        ));
    }

    public function printPdf()
    {
        // Data sama seperti index, bisa ambil dari database
        $nama_sppg = 'SPPG Contoh';
        $kelurahan = 'Kelurahan Contoh';
        $kecamatan = 'Kecamatan Contoh';
        $kabupaten = 'Kabupaten Contoh';
        $provinsi = 'Provinsi Contoh';
        $periode = 'Juli 2025';

        $saldo_awal = 1000000;
        $penerimaan = 6000000;
        $bahan_pangan = 3000000;
        $operasional = 2000000;
        $sewa = 500000;
        $total_pengeluaran = $bahan_pangan + $operasional + $sewa;
        $saldo_akhir = $saldo_awal + $penerimaan - $total_pengeluaran;

        return PDF::loadView('laporan.lpd', compact(
            'nama_sppg', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'periode',
            'saldo_awal', 'penerimaan', 'bahan_pangan', 'operasional', 'sewa',
            'total_pengeluaran', 'saldo_akhir'
        ))->download('lpd.pdf');
    }
}