@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Gunung</h1>
    <form action="{{ route('gunung.update', $gunung->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('gunung.form')
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
