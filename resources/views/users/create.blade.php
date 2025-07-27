// filepath: resources/views/users/create.blade.php
@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <h4 class="mb-3">Tambah User</h4>
  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
  </form>
</div>
@endsection