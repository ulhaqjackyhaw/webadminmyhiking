@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Pesanan</title>
</head>
<body style="background: #117958">
    <div class="container bg-white p-4 rounded">
        <h1 class="text-center my-4" style="font-weight: bold; color: black;">Detail Pesanan</h1>

        <!-- Detail Pesanan -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="text-left mb-4">Pesanan #{{ $pesanan->id }}</h3>
                    <table class="table table-bordered mx-auto">
                        <tr>
                            <th>Pendaki</th>
                            <td>
                                @foreach ($pesanan->anggotaPesanan as $anggota)
                                    <li>{{ $anggota->user->name ?? 'Tidak Diketahui' }}</li>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Gunung</th>
                            <td>{{ $pesanan->gunung->nama ?? 'Tidak Diketahui' }}</td>
                        </tr>
                        <tr>
                            <th>Jalur</th>
                            <td>{{ $pesanan->jalur->nama ?? 'Tidak Diketahui' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Naik</th>
                            <td>{{ $pesanan->tanggal_naik->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Turun</th>
                            <td>{{ $pesanan->tanggal_turun->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Harga Tiket</th>
                            <td>Rp {{ number_format($pesanan->total_harga_tiket, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($pesanan->status == 'Booking')
                                    <span style="font-weight: bold; color: orange;">Booking</span>
                                @elseif($pesanan->status == 'Sedang Mendaki')
                                    <span style="font-weight: bold; color: green;">Mendaki</span>
                                @elseif($pesanan->status == 'Selesai')
                                    <span style="font-weight: bold; color: black;">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Tombol Ganti Status dan Kembali -->
                    @if($pesanan->status != 'Selesai')
                    <form action="{{ route('riwayat.updateStatus', $pesanan->id) }}" method="POST" class="d-flex justify-content-between align-items-center mt-4">
                        @csrf
                        @method('PUT')

                        <!-- Tombol Ganti Status -->
                        @if($pesanan->status == 'Booking')
                            <button type="submit" name="status" value="Sedang Mendaki" class="btn" style="background-color: orange; color: white;">Ganti ke Mendaki</button>
                        @elseif($pesanan->status == 'Sedang Mendaki')
                            <button type="submit" name="status" value="Selesai" class="btn" style="background-color: orange; color: white;">Ganti ke Selesai</button>
                        @endif

                        <!-- Tombol Kembali -->
                        <a href="{{ route('riwayat.index') }}" class="btn" style="background-color: #117958; color: white;">Kembali ke Daftar Riwayat</a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
