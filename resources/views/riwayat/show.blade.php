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
        <h1 class="text-center my-4" style="font-weight: bold; color: black;">Detail Riwayat</h1>
        
        <!-- Detail Pesanan -->
        <div class="row">
            <div class="col-md-8">
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Pesanan #{{ $pesanan->id }}</h3>
                        <hr/>
                        <p><strong>ID User:</strong> {{ $pesanan->anggotaPesanan->id_users ?? 'Tidak Diketahui' }}</p>
                        <p><strong>ID Gunung:</strong> {{ $pesanan->id_gunung }}</p>
                        <p><strong>ID Jalur:</strong> {{ $pesanan->id_jalur }}</p>
                        <p><strong>Tanggal Naik:</strong> {{ $pesanan->tanggal_naik->format('d M Y') }}</p>
                        <p><strong>Tanggal Turun:</strong> {{ $pesanan->tanggal_turun->format('d M Y') }}</p>
                        <p><strong>Total Harga Tiket:</strong> Rp {{ number_format($pesanan->total_harga_tiket, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            @if($pesanan->status == 'Booking')
                                <span style="font-weight: bold; color: orange;">Booking</span>
                            @elseif($pesanan->status == 'Sedang Mendaki')
                                <span style="font-weight: bold; color: green;">Mendaki</span>
                            @elseif($pesanan->status == 'Selesai')
                                <span style="font-weight: bold; color: black;">Selesai</span>
                            @endif
                        </p>
                        
                        <!-- Tombol Ganti Status (Tombol hanya muncul jika status bukan Selesai) -->
                        @if($pesanan->status != 'Selesai')
                        <form action="{{ route('riwayat.updateStatus', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <!-- Menampilkan tombol sesuai dengan status saat ini -->
                                @if($pesanan->status == 'Booking')
                                    <button type="submit" name="status" value="Sedang Mendaki" class="btn" style="background-color: orange; color: white;">Ganti ke Mendaki</button>
                                @elseif($pesanan->status == 'Sedang Mendaki')
                                    <button type="submit" name="status" value="Selesai" class="btn" style="background-color: orange; color: white;">Ganti ke Selesai</button>
                                @endif
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali ke Daftar Riwayat dengan jarak -->
        <a href="{{ route('riwayat.index') }}" class="btn" style="background-color: #117958; color: white; border: none; margin-top: 20px;">Kembali ke Daftar Riwayat</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
