@extends('layouts.app')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body style="background: #117958">
    <div class="container bg-white p-4 rounded">
                    <h1 class="text-center my-4" style="font-weight: bold; color: black;">Daftar Gunung</h1> <!-- Gaya font disamakan -->
                    <!-- Baris untuk tombol "Tambah Gunung" dan form pencarian -->
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('gunung.create') }}" class="btn"
                           style="background-color: #117958; color: white; border: none;">Tambah Gunung</a> <!-- Gaya tombol disamakan -->
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
                        <thead style="background-color: #d4edda;"> <!-- Gaya tabel disamakan -->
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama gunung</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">Ketinggian</th>
                                <th scope="col">Gambar</th>
                                <th scope="col" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gunungs as $gunung)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style=>{{ $gunung->nama }}</td> <!-- Warna teks hijau disamakan -->
                                <td>{{ $gunung->province->name ?? 'Tidak Diketahui' }}</td> <!-- Menampilkan Nama Provinsi -->
                                <td>{{ $gunung->regency->name ?? 'Tidak Diketahui' }}</td> <!-- Menampilkan Nama Kabupaten -->
                                <td>{{ $gunung->ketinggian }} mdpl</td>
                                <td class="text-center">
                                    @if ($gunung->gambar)
                                    <img src="{{ asset('storage/' . $gunung->gambar) }}" class="rounded" style="width: 150px">
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
