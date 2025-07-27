@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm p-3">
        <div class="card-header">
          <h5 class="card-title fw-bold">Edit Pengeluaran</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('expenses.update', $expense->id_expense) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="date">Tanggal</label>
              <input type="date" class="form-control" id="date" name="date" value="{{ $expense->date }}">
            </div>
            <div class="form-group">
              <label for="amount">Jumlah</label>
              <input type="number" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}">
            </div>
            <div class="form-group">
              <label for="id_category">Kategori</label>
              <select class="form-control" id="id_category" name="id_category">
                @foreach($categories as $category)
                  <option value="{{ $category->id_category }}" {{ $expense->id_category == $category->id_category ? 'selected' : '' }}>
                    {{ $category->name_category }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <input type="text" class="form-control" id="description" name="description" value="{{ $expense->description }}">
            </div>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
            <a href="{{ route('expenses') }}" class="btn btn-sm btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection