@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Gunung</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $gunung->nama }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Provinsi:</strong> {{ $gunung->province_id }}</p>
            <p><strong>Kabupaten/Kota:</strong> {{ $gunung->regency_id }}</p>
            <p><strong>Kecamatan:</strong> {{ $gunung->district_id }}</p>
            <p><strong>Desa:</strong> {{ $gunung->village_id }}</p>
            <p><strong>Ketinggian:</strong> {{ $gunung->ketinggian }} meter</p>
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $gunung->deskripsi }}</p>

            @if ($gunung->gambar)
            <p><strong>Gambar:</strong></p>
            <img src="{{ asset('storage/' . $gunung->gambar) }}" alt="Gambar {{ $gunung->nama }}" class="img-fluid" style="max-width: 100%; height: auto;">
            @endif
        </div>
    </div>
</div>
@endsection
