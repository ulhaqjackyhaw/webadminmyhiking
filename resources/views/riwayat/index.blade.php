@extends('layouts.admin')

@section('main-content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="background: #117958;">
    <div class="container bg-white p-4 rounded">
        <h1 class="text-center my-4" style="font-weight: bold; color: black;">Riwayat Pesanan</h1>
        
        <!-- Scanner -->
        <div id="reader" style="width: 100%; max-width: 600px; margin: auto;"></div>

        <!-- Tombol tambah dan pencarian -->
        <div class="d-flex justify-content-end mb-3">
    <form action="{{ route('riwayat.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control" placeholder="Cari pesanan..." value="{{ request()->get('search') }}" style="margin-right: 10px;">
        <button type="submit" class="btn" style="background-color: #007bff; color: white;">Cari</button>
    </form>
</div>

        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel Riwayat Pesanan -->
        <table class="table table-bordered">
            <thead style="background-color: #d4edda;">
                <tr>
                    <th class="text-center">ID Pesanan</th>
                    <th class="text-center">ID User</th>
                    <th class="text-center">Tanggal Naik</th>
                    <th class="text-center">Tanggal Turun</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatPesanan as $p)
                <tr>
                    <td class="text-center">{{ $p->id }}</td>
                    <!-- Menampilkan ID User dari anggotaPesanan -->
                    <td class="text-center">{{ $p->anggotaPesanan->id_users ?? 'Tidak Diketahui' }}</td>
                    <td class="text-center">{{ $p->tanggal_naik->format('d M Y') }}</td>
                    <td class="text-center">{{ $p->tanggal_turun->format('d M Y') }}</td>
                    <td class="text-center">
                        <!-- Menampilkan status dengan warna -->
                        @if ($p->status == 'Booking')
                            <span style="font-weight: bold; color: orange;">Booking</span>
                        @elseif ($p->status == 'Sedang Mendaki')
                            <span style="font-weight: bold; color: green;">Mendaki</span>
                        @elseif ($p->status == 'Selesai')
                            <span style="font-weight: bold; color: black;">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('riwayat.show', $p->id) }}" class="btn btn-sm btn-info">DETAIL</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    

</body>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>

function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code matched = ${decodedText}`, decodedResult);

    // Redirect ke halaman detail dengan ID yang di-scan
    window.location.href = `/riwayat/${decodedText}`;
}

function onScanFailure(error) {
    console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: { width: 250, height: 250 } },
    false
);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);


</script> -->
@endsection
