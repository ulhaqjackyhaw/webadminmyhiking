@extends('layouts.app')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
<div class="container mt-0.1">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h2 class="text-center my-4">Daftar Gunung</h2>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                <!-- Baris untuk tombol "Tambah Gunung" dan form pencarian -->
                <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('gunung.create') }}" class="btn btn-md btn-success">Tambah Gunung</a>

                        <!-- Form Pencarian -->
                        <form action="{{ route('gunung.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Cari gunung..." value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-primary ms-2">Cari</button>
                        </form>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NAMA GUNUNG</th>
                                <th scope="col">PROVINSI</th>
                                <th scope="col">KABUPATEN</th>
                                <th scope="col">KETINGGIAN</th>
                                <th scope="col">GAMBAR</th>
                                <th scope="col" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gunungs as $gunung)
                                <tr>
                                    <td>{{ $gunung->id }}</td>
                                    <td>{{ $gunung->nama }}</td>
                                    <td>{{ $gunung->province_id }}</td>
                                    <td>{{ $gunung->regency_id }}</td>
                                    <td>{{ $gunung->ketinggian }} mdpl</td>
                                    <td class="text-center">
                                        @if ($gunung->gambar)
                                            <img src="{{ asset('/storage/gunung/'.$gunung->gambar) }}" class="rounded" style="width: 150px">
                                        @else
                                            <span>Tidak Ada Gambar</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Yakin ingin menghapus?');" action="{{ route('gunung.destroy', $gunung->id) }}" method="POST">
                                            <a href="{{ route('gunung.show', $gunung->id) }}" class="btn btn-sm btn-dark">DETAIL</a>
                                            <a href="{{ route('gunung.edit', $gunung->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
