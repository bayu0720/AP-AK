@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="table-responsive shadow-sm p-3">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <a href="{{ route('incomes.addPage') }}" class="btn btn-sm btn-primary mb-3">
          <i class="fas fa-plus"></i>
          Tambah Data Pemasukan
        </a>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <thead>
          <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Kategori</th>
            <th scope="col">Deskripsi</th>
             <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($incomes as $income)
          <tr>
            <td>{{ $income->date }}</td>
            <td>Rp {{ number_format($income->amount, 0, ',', '.') }}</td>
            <td>
                @foreach($categories as $category)
                    @if($category->id_category == $income->id_category)
                        <span class="badge badge-pill badge-primary">{{ $category->name_category }}</span>
                    @endif
                @endforeach
            </td>
            <td>{{ $income->description }}</td>
            <td>
            <a href="{{ route('incomes.editPage', $income->id_income) }}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i> Edit
            </a>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteIncomeModal{{ $income->id_income }}">
              <i class="fas fa-trash"></i> Delete
            </button>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @foreach($incomes as $income)
    <div class="modal fade" id="deleteIncomeModal{{ $income->id_income }}" tabindex="-1" aria-labelledby="deleteIncomeModal{{ $income->id_income }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hapus Data Pemasukan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus pemasukan "{{ $income->description }}"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form action="{{ route('incomes.delete', $income->id_income) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection