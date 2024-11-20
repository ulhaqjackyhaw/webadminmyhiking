@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Jalur</h1>
    <form action="{{ route('jalur.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_gunung" class="form-label">Gunung</label>
            <select name="id_gunung" class="form-control">
                <option value="">-- Pilih Gunung --</option>
                @foreach ($gunung as $g)
                <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="province_id" class="form-label">Provinsi</label>
            <input type="text" name="province_id" class="form-control">
        </div>
        <!-- Tambahkan input lainnya -->
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
