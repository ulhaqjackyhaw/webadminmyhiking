@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 rounded">
    <h1 class="text-center mb-4" style="font-weight: bold; color: black;">Rincian Transaksi</h1>
    <table class="table table-bordered">
        <tr>
            <th style="width: 30%;">ID Transaksi</th>
            <td>{{ $transaksi->id }}</td>
        </tr>
        <tr>
            <th>ID Pesanan</th>
            <td>{{ $transaksi->id_pesanan }}</td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td>{{ $transaksi->metode_pembayaran }}</td>
        </tr>
        <tr>
            <th>Total Bayar</th>
            <td>{{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Waktu Pembayaran</th>
            <td>{{ $transaksi->formatted_waktu_pembayaran }}</td>
        </tr>
        <tr>
            <th>Bukti Pembayaran</th>
            <td class="text-center">
                @if ($transaksi->bukti)
                <img src="{{ asset($transaksi->bukti) }}" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 300px; border-radius: 5px;">
                @else
                <p class="text-danger">Tidak ada bukti pembayaran.</p>
                @endif
            </td>
        </tr>
    </table>
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary" style="background-color: #117958; border: none;">Kembali ke Daftar Transaksi</a>
    </div>
</div>
@endsection
