@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Jalur</h1>
    <form action="{{ route('jalur.store') }}" method="POST">
        {{csrf_field()}}
        
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Jalur</label>
            <input type="text" name="nama" class="form-control">
        </div>


        <!-- Dropdown Provinsi -->
        <div class="form-group">
            <label for="province_id">Provinsi</label>
            <select id="province_id" name="province_id" class="form-control">
            <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($province_id as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
                    <!-- Tambahkan opsi lainnya -->
            </select>
        </div>
        <!-- Dropdown regency -->
        <div class="form-group">
            <label for="regency_id">Kabupaten</label>
            <select id="regency_id" name="regency_id" class="form-control">
            <option value="" disabled selected>Pilih Kabupaten</option>
                @foreach($regency_id as $regency)
                    <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                @endforeach
                    <!-- Tambahkan opsi lainnya -->
            </select>
        </div>
        <!-- Dropdown district -->
        <div class="form-group">
            <label for="district_id">Kecamatan</label>
            <select id="district_id" name="district_id" class="form-control">
            <option value="" disabled selected>Pilih Kecamatan</option>
                @foreach($district_id as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
                    <!-- Tambahkan opsi lainnya -->
            </select>
        </div>
        <!-- Dropdown village -->
        <div class="form-group">
            <label for="village_id">Desa</label>
            <select id="village_id" name="village_id" class="form-control">
            <option value="" disabled selected>Pilih Desa</option>
                @foreach($village_id as $village)
                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                @endforeach
                    <!-- Tambahkan opsi lainnya -->
            </select>
        </div>

        <div class="mb-3">
            <label for="jarak" class="form-label">Jarak</label>
            <input type="text" name="jarak" class="form-control">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control">
        </div>
        <div class="mb-3">
            <label for="map_basecamp" class="form-label">Map Basecamp</label>
            <input type="text" name="map_basecamp" class="form-control">
        </div>
        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input type="text" name="biaya" class="form-control">
        </div>

        <!-- Tambahkan input lainnya -->
        <button type="submit" name="kirim" class="btn btn-success">Simpan</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika provinsi dipilih
            $('#province_id').change(function() {
                let provinceId = $(this).val();
                $('#regency_id').empty().append('<option value="" disabled selected>Loading...</option>');
                $('#district_id').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>');
                $('#village_id').empty().append('<option value="" disabled selected>Pilih Desa</option>');
                
                $.get(`/get-regencies/${provinceId}`, function(data) {
                    $('#regency_id').empty().append('<option value="" disabled selected>Pilih Kabupaten</option>');
                    $.each(data, function(index, regency) {
                        $('#regency_id').append(`<option value="${regency.id}">${regency.name}</option>`);
                    });
                });
            });

            // Ketika kabupaten dipilih
            $('#regency_id').change(function() {
                let regencyId = $(this).val();
                $('#district_id').empty().append('<option value="" disabled selected>Loading...</option>');
                $('#village_id').empty().append('<option value="" disabled selected>Pilih Desa</option>');
                
                $.get(`/get-districts/${regencyId}`, function(data) {
                    $('#district_id').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>');
                    $.each(data, function(index, district) {
                        $('#district_id').append(`<option value="${district.id}">${district.name}</option>`);
                    });
                });
            });

            // Ketika kecamatan dipilih
            $('#district_id').change(function() {
                let districtId = $(this).val();
                $('#village_id').empty().append('<option value="" disabled selected>Loading...</option>');
                
                $.get(`/get-villages/${districtId}`, function(data) {
                    $('#village_id').empty().append('<option value="" disabled selected>Pilih Desa</option>');
                    $.each(data, function(index, village) {
                        $('#village_id').append(`<option value="${village.id}">${village.name}</option>`);
                    });
                });
            });
        });
    </script>

</div>
@endsection
