@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Gunung</h1>
    <a href="{{ route('gunung.create') }}" class="btn btn-primary mb-3">Tambah Gunung</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                                <th>ID</th>
                                <th>Nama Gunung</th>
                                <th>Provinsi</th>
                                <th>Kabupaten</th>
                                <th>Ketinggian</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gunungs as $index => $gunung)
            <tr>
                                    <td>{{ $gunung->id }}</td>
                                    <td>{{ $gunung->nama }}</td>
                                    <td>{{ $gunung->province_id }}</td>
                                    <td>{{ $gunung->regency_id }}</td>
                                    <td>{{ $gunung->ketinggian }} mdpl</td>
                                    <td>{{ $gunung->gambar }} </td>
                <td>
                    <a href="{{ route('gunung.show', $gunung->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('gunung.edit', $gunung->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('gunung.destroy', $gunung->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
