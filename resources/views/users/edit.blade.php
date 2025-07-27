// filepath: resources/views/users/edit.blade.php
@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <h4 class="mb-3">Edit User</h4>
  <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <button type="submit" class="btn btn-sm btn-success">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
  </form>
</div>
@endsection