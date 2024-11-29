@extends('layouts.admin')

@section('main-content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body style="background: #117958">
    <div class="container bg-white p-4 rounded">
        <h1 class="text-center my-4" style="font-weight: bold; color: black;">Daftar Jalur</h1> <!-- Gaya font disamakan -->
        <!-- Baris untuk tombol "Tambah Jalur" dan form pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('jalur.create') }}" class="btn"
               style="background-color: #117958; color: white; border: none;">Tambah Jalur</a> <!-- Gaya tombol disamakan -->
            <!-- Form Pencarian -->
            <form action="{{ route('jalur.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Cari jalur..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn" style="background-color: #007bff; color: white;">Cari</button>
            </form>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead style="background-color: #d4edda;">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Gunung</th>
                    <th scope="col" class="text-center">Provinsi</th>
                    <th scope="col" class="text-center">Kabupaten</th>
                    <th scope="col" class="text-center">Kecamatan</th>
                    <th scope="col" class="text-center">Desa</th>
                    <th scope="col" class="text-center">Jarak</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Map Basecamp</th>
                    <th scope="col" class="text-center">Biaya</th>
                    <th scope="col" class="text-center" style="width: 13%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jalur as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->gunung->nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $j->province->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $j->regency->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $j->district->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $j->village->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $j->jarak }} km</td>
                    <td>{{ $j->deskripsi }}</td>
                    <td>{{ $j->map_basecamp }}</td>
                    <td>Rp {{ number_format($j->biaya, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Yakin ingin menghapus jalur ini?');" action="{{ route('jalur.destroy', $j->id) }}" method="POST">
                            <a href="{{ route('jalur.edit', $j->id) }}" class="btn btn-sm" style="background-color: #28a745; color: white;">EDIT</a>
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
</body>
@endsection
