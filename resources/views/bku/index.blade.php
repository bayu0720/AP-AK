<!-- filepath: resources/views/bku/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('bku.pdf') }}" class="btn btn-sm btn-primary mb-3" target="_blank">
                <i class="fas fa-print"></i> Cetak PDF
            </a>
            <div class="card shadow-sm p-3">
                <div class="card-header">
                    <h5 class="card-title fw-bold">BUKU KAS UMUM</h5>
                    <p>Periode: {{ $periode }}</p>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" cellspacing="0">
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
                                $saldo = $saldo_awal;
                                $no = 1;
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $tanggal_awal }}</td>
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
                    <b>Catatan Penting:</b>
                    <ol>
                        <li>Seluruh transaksi uang keluar dan masuk wajib dicatat pada BKU.</li>
                        <li>Pencatatan secara tertib dengan mengikuti kronologis waktu/kejadian transaksi dan secara harian.</li>
                        <li>Periode adalah periode operasional dapur SPPG selama 2 pekan/minggu.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection