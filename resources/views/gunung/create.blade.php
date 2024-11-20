@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Gunung</h1>
    <form action="{{ route('gunung.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('gunung.form')
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
