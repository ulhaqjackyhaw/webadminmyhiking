@extends('layouts.app')

@section('content')
<div style="background-color: #117958; padding: 20px;">
    <div class="container bg-white p-4 rounded">
        <h1 class="text-center mb-4 text-black" style="font-weight: bold;">Daftar Jalur</h1> <!-- Warna teks putih -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('jalur.create') }}"
               class="btn"
               style="background-color: #117958; color: white; border: none;">Tambah Jalur</a> <!-- Warna tombol -->
            <input id="searchInput" type="text" class="form-control w-25" placeholder="Cari nama jalur...">
        </div>
        <table class="table" id="jalurTable">
            <thead style="background-color: #d4edda;">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gunung</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Jarak</th>
                    <th>Deskripsi</th>
                    <th>Map Basecamp</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jalur as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="nama-jalur" style="color: green;">{{ $j->nama }}</td> <!-- Warna teks hijau -->
                    <td>{{ $j->gunung->nama ?? 'Gak ono' }}</td>
                    <td>{{ $j->province->name ?? 'N/A' }}</td>
                    <td>{{ $j->regency->name ?? 'N/A' }}</td>
                    <td>{{ $j->district->name ?? 'N/A' }}</td>
                    <td>{{ $j->village->name ?? 'N/A' }}</td>
                    <td>{{ $j->jarak }}</td>
                    <td>{{ $j->deskripsi }}</td>
                    <td>{{ $j->map_basecamp }}</td>
                    <td>{{ $j->biaya }}</td>
                    <td>
                        <a href="{{ route('jalur.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jalur.destroy', $j->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus jalur ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#jalurTable tbody tr');

        rows.forEach(row => {
            const namaJalur = row.querySelector('.nama-jalur').textContent.toLowerCase();
            if (namaJalur.includes(query)) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    });
</script>
@endsection
