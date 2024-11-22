<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use App\Models\Gunung;
use Illuminate\Http\Request;
use App\Models\Province; // Import model Provinsi
use App\Models\Regency; // Import model Provinsi
use App\Models\District; // Import model Provinsi
use App\Models\Village; // Import model Provinsi


class JalurController extends Controller
{
    public function index()
    {
        $jalur = Jalur::with('gunung')->get();
        return view('jalur.index', compact('jalur'));
    }

    public function create()
    {
        $pegunungan = Gunung::all();
        $nama = request()->all();
        $province_id = Province::all(); // Mengambil semua data provinsi
        $regency_id = Regency::all(); // Mengambil semua data provinsi
        $district_id = District::all(); // Mengambil semua data provinsi
        $village_id = Village::all(); // Mengambil semua data provinsi
        $jarak = request()->all();
        $deskripsi = request()->all();
        $map_basecamp = request()->all();
        $biaya = request()->all();
        return view('jalur.create', compact('province_id' , 'regency_id' , 'district_id' , 'village_id', 'pegunungan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'province_id' => 'required|integer|exists:reg_provinces,id',
            'regency_id' => 'required|integer|exists:reg_regencies,id',
            'district_id' => 'required|integer|exists:reg_districts,id',
            'village_id' => 'required|integer|exists:reg_villages,id',
            'jarak' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:1000',
            'map_basecamp' => 'nullable|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        Jalur::create([
            'nama' => $request->nama,
            'id_gunung' => $request->id_gunung,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'jarak' => $request->jarak,
            'deskripsi' => $request->deskripsi,
            'map_basecamp' => $request->map_basecamp,
            'biaya' => $request->biaya,

        ]);

        return redirect('jalur');

        // dd($request->all());
        // $request->validate([
        //     'id_gunung' => 'nullable|exists:gunung,id',
        //     'nama' => 'required|string|max:60',
        //     'province_id' => 'required|size:2',
        //     'regency_id' => 'required|size:4',
        //     'district_id' => 'required|size:7',
        //     'village_id' => 'required|size:10',
        //     'deskripsi' => 'required|string',
        //     'map_basecamp' => 'required|string|max:60',
        //     'biaya' => 'required|integer',
        // ]);

        // Jalur::create($request->all());
        // return redirect()->route('jalur.index')->with('success', 'Jalur berhasil ditambahkan');
    }

    public function show(Jalur $jalur)
    {
        return view('jalur.show', compact('jalur'));
    }

    public function edit($id)
    {
        // $gunung = Gunung::all();
        // return view('jalur.edit', compact('jalur', 'gunung'));
        
        $pegunungan = Gunung::all();
        $jalur = Jalur::findOrFail($id); // Ambil data jalur berdasarkan ID
        $provinces = Province::all(); // Ambil semua data provinsi
        $regencies = Regency::where('province_id', $jalur->province_id)->get(); // Kabupaten berdasarkan provinsi
        $districts = District::where('regency_id', $jalur->regency_id)->get(); // Kecamatan berdasarkan kabupaten
        $villages = Village::where('district_id', $jalur->district_id)->get(); // Desa berdasarkan kecamatan

        return view('jalur.edit', compact('jalur', 'provinces', 'regencies', 'districts', 'villages', 'pegunungan'));

    } 

    //

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'province_id' => 'required|integer|exists:reg_provinces,id',
            'regency_id' => 'required|integer|exists:reg_regencies,id',
            'district_id' => 'required|integer|exists:reg_districts,id',
            'village_id' => 'required|integer|exists:reg_villages,id',
            'jarak' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'map_basecamp' => 'nullable|string|max:255',
            'biaya' => 'required|integer|min:0',
        ]);

        $updateJalur = Jalur::find($id);
        $updateJalur->update([
            'nama'           => $request->nama,
            'id_gunung' => $request->id_gunung,
            'province_id'          => $request->province_id,
            'regency_id'        => $request->regency_id,
            'disrict_id'     => $request->district_id,
            'village_id'       => $request->village_id,
            'jarak' => $request->jarak,
            'deskripsi' => $request->deskripsi,
            'map_basecamp' => $request->map_basecamp,
            'biaya' => $request->biaya,
        ]);
        return redirect()->route('jalur.index')->with('success', 'Jalur berhasil diupdate');

        // dd($request->all());
    }

    public function destroy($id)
    {
        $jalur = Jalur::findOrFail($id);
        $jalur->delete();
        return redirect()->route('jalur.index')->with('success', 'Jalur berhasil dihapus');
    }
}