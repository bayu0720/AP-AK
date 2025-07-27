<?php
namespace App\Http\Controllers;

use App\Models\Incomes;
use App\Models\Expenses;
use Illuminate\Http\Request;
use PDF;

class BKUController extends Controller
{

    public function index()
    {
        $incomes = Incomes::all();
        $expenses = Expenses::all();

        $bku = collect($incomes)
            ->map(function ($item) { $item->type = 'Pemasukan'; return $item; })
            ->merge(
                collect($expenses)->map(function ($item) { $item->type = 'Pengeluaran'; return $item; })
            )
            ->sortBy('date')
            ->values();

        $saldo_awal = 1000000;
        $tanggal_awal = $bku->first()->date ?? '';
        $periode = '1 Januari 2025 s.d. 23 Januari 2025';

        // Data header BKU
        $nama_sppg = 'SPPG Contoh';
        $kelurahan = 'Kelurahan Contoh';
        $kecamatan = 'Kecamatan Contoh';
        $kabupaten = 'Kabupaten Contoh';
        $provinsi = 'Provinsi Contoh';

        // Hitung total pemasukan dan pengeluaran
        $total_pemasukan = $bku->where('type', 'Pemasukan')->sum('amount');
        $total_pengeluaran = $bku->where('type', 'Pengeluaran')->sum('amount');
        $saldo_akhir = $saldo_awal + $total_pemasukan - $total_pengeluaran;

        return view('bku.index', compact(
            'bku', 'saldo_awal', 'tanggal_awal', 'periode',
            'nama_sppg', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
            'total_pemasukan', 'total_pengeluaran', 'saldo_akhir'
        ));
    }

    public function printPdf()
    {
        $incomes = Incomes::all();
        $expenses = Expenses::all();
        $bku = collect($incomes)
            ->map(function ($item) { $item->type = 'Pemasukan'; return $item; })
            ->merge(collect($expenses)->map(function ($item) { $item->type = 'Pengeluaran'; return $item; }))
            ->sortBy('date');

        $saldo_awal = 1000000;
        $tanggal_awal = $bku->first()->date ?? '';
        $periode = '1 Januari 2025 s.d. 23 Januari 2025';

        $nama_sppg = 'SPPG Contoh';
        $kelurahan = 'Kelurahan Contoh';
        $kecamatan = 'Kecamatan Contoh';
        $kabupaten = 'Kabupaten Contoh';
        $provinsi = 'Provinsi Contoh';

        $total_pemasukan = $bku->where('type', 'Pemasukan')->sum('amount');
        $total_pengeluaran = $bku->where('type', 'Pengeluaran')->sum('amount');
        $saldo_akhir = $saldo_awal + $total_pemasukan - $total_pengeluaran;

        return PDF::loadView('bku.pdf', compact(
            'bku', 'saldo_awal', 'tanggal_awal', 'periode',
            'nama_sppg', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
            'total_pemasukan', 'total_pengeluaran', 'saldo_akhir'
        ))->download('bku.pdf');
    }
}