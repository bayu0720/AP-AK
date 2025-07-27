@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm p-3">
        <div class="card-header">
          <h5 class="card-title fw-bold">Edit Pemasukan</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('incomes.update', $income->id_income) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="date">Tanggal</label>
              <input type="date" class="form-control" id="date" name="date" value="{{ $income->date }}">
            </div>
            <div class="form-group">
              <label for="amount">Jumlah</label>
              <input type="number" class="form-control" id="amount" name="amount" value="{{ $income->amount }}">
            </div>
            <div class="form-group">
              <label for="id_category">Kategori</label>
              <select class="form-control" id="id_category" name="id_category">
                @foreach($categories as $category)
                  <option value="{{ $category->id_category }}" {{ $income->id_category == $category->id_category ? 'selected' : '' }}>
                    {{ $category->name_category }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <input type="text" class="form-control" id="description" name="description" value="{{ $income->description }}">
            </div>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection