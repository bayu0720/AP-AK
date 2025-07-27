@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="table-responsive shadow-sm p-3">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <a href="{{ route('journal.create') }}" class="btn btn-sm btn-primary mb-3">
          <i class="fas fa-plus"></i>
          Tambah Jurnal
        </a>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Akun</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($journals as $journal)
          <tr>
            <td>{{ $journal->id }}</td>
            <td>{{ $journal->date }}</td>
            <td>{{ $journal->description }}</td>
            <td>{{ $journal->account }}</td>
            <td>{{ number_format($journal->debit, 2) }}</td>
            <td>{{ number_format($journal->credit, 2) }}</td>
            <td>
              <a href="{{ route('journal.edit', $journal->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
                Edit
              </a>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteJournalModal{{ $journal->id }}">
                <i class="fas fa-trash"></i>
                Delete
              </button>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>

    @foreach($journals as $journal)
    <div class="modal fade" id="deleteJournalModal{{ $journal->id }}" tabindex="-1" aria-labelledby="deleteJournalModal{{ $journal->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteJournalModal{{ $journal->id }}">Hapus Data Jurnal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus jurnal dengan deskripsi "{{ $journal->description }}"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" style="display:inline;">
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