@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="table-responsive shadow-sm p-3">
    

      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Periode</th>
            <th scope="col">Saldo Awal</th>
            <th scope="col">Penerimaan Dana</th>
            <th scope="col">Bahan Pangan</th>
            <th scope="col">Operasional</th>
            <th scope="col">Sewa</th>
            <th scope="col">Total Pengeluaran</th>
            <th scope="col">Saldo Akhir</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($lpds as $lpd)
          <tr>
            <td>{{ $lpd->id }}</td>
            <td>{{ $lpd->periode }}</td>
            <td>{{ number_format($lpd->saldo_awal, 2) }}</td>
            <td>{{ number_format($lpd->penerimaan, 2) }}</td>
            <td>{{ number_format($lpd->bahan_pangan, 2) }}</td>
            <td>{{ number_format($lpd->operasional, 2) }}</td>
            <td>{{ number_format($lpd->sewa, 2) }}</td>
            <td>{{ number_format($lpd->total_pengeluaran, 2) }}</td>
            <td>{{ number_format($lpd->saldo_akhir, 2) }}</td>
            <td>
              <a href="{{ route('lpd.edit', $lpd->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
              </a>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteLpdModal{{ $lpd->id }}">
                <i class="fas fa-trash"></i> Delete
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @foreach($lpds as $lpd)
    <div class="modal fade" id="deleteLpdModal{{ $lpd->id }}" tabindex="-1" aria-labelledby="deleteLpdModal{{ $lpd->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteLpdModal{{ $lpd->id }}">Hapus Laporan Penggunaan Dana</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus laporan periode "{{ $lpd->periode }}"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form action="{{ route('lpd.destroy', $lpd->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection