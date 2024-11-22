@extends('layouts.app')

@section('content')
<div style="background-color: #117958; padding: 20px;">
    <div class="container bg-white p-4 rounded">
        <h1 class="text-center mb-4 text-black" style="font-weight: bold;">Daftar Jalur</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('jalur.create') }}" class="btn" style="background-color: #117958; color: white; border: none;">Tambah Jalur</a>

            <!-- Form Pencarian -->
            <form action="{{ route('jalur.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Cari jalur..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary ms-2" style="background-color: #0096FF; color: white;">Cari</button>
            </form>
        </div>

        <!-- Menampilkan notifikasi sukses jika ada, di bawah tombol tambah jalur -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table" id="jalurTable">
            <thead style="background-color: #d4edda;">
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>GUNUNG</th>
                    <th>PROVINSI</th>
                    <th>KABUPATEN</th>
                    <th>KECAMATAN</th>
                    <th>DESA</th>
                    <th>JARAK</th>
                    <th>DESKRIPSI</th>
                    <th>MAP BASECAMP</th>
                    <th>BIAYA</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jalur as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="nama-jalur" style="color: black;">{{ $j->nama }}</td>
                    <td>{{ $j->gunung->nama ?? 'Gak ono' }}</td>
                    <td>{{ $j->province->name ?? 'N/A' }}</td>
                    <td>{{ $j->regency->name ?? 'N/A' }}</td>
                    <td>{{ $j->district->name ?? 'N/A' }}</td>
                    <td>{{ $j->village->name ?? 'N/A' }}</td>
                    <td>{{ $j->jarak }}</td>
                    <td>{{ $j->deskripsi }}</td>
                    <td>{{ $j->map_basecamp }}</td>
                    <td>{{ $j->biaya }}</td>
                    <td class="d-flex gap-2">
                        <!-- Tombol Edit Berwarna Biru -->
                        <a href="{{ route('jalur.edit', $j->id) }}" class="btn btn-primary btn-sm me-2" style="background-color: #0096FF; border-color: #007bff;">EDIT</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('jalur.destroy', $j->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus jalur ini?')">HAPUS</button>
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
            row.style.display = namaJalur.includes(query) ? '' : 'none';
        });
    });
</script>
@endsection
