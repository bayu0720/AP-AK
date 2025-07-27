@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <h4 class="mb-3">Daftar User</h4>
  <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary mb-3">Tambah User</a>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection