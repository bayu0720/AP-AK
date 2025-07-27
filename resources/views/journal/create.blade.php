@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm p-3">
        <div class="card-header">
          <h5 class="card-title fw-bold">{{ $title ?? 'Tambah Jurnal' }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('journal.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="date">Tanggal</label>
              <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}">
              @error('date')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
              @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="account">Akun</label>
              <input type="text" class="form-control @error('account') is-invalid @enderror" id="account" name="account" value="{{ old('account') }}">
              @error('account')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="debit">Debit</label>
              <input type="number" step="0.01" class="form-control @error('debit') is-invalid @enderror" id="debit" name="debit" value="{{ old('debit') }}">
              @error('debit')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="credit">Kredit</label>
              <input type="number" step="0.01" class="form-control @error('credit') is-invalid @enderror" id="credit" name="credit" value="{{ old('credit') }}">
              @error('credit')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            <a href="{{ route('journal.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection