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
        // $gunung = Gunung::all();
        $nama = request()->all();
        $province_id = Province::all(); // Mengambil semua data provinsi
        $regency_id = Regency::all(); // Mengambil semua data provinsi
        $district_id = District::all(); // Mengambil semua data provinsi
        $village_id = Village::all(); // Mengambil semua data provinsi
        $jarak = request()->all();
        $deskripsi = request()->all();
        $map_basecamp = request()->all();
        $biaya = request()->all();
        return view('jalur.create', compact('province_id' , 'regency_id' , 'district_id' , 'village_id'));
    }


    public function store(Request $request)
    {

        Jalur::create([
            'nama' => $request->nama,
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

    public function edit(Jalur $jalur)
    {
        $gunung = Gunung::all();
        return view('jalur.edit', compact('jalur', 'gunung'));
    }

    public function update(Request $request, Jalur $jalur)
    {
        $request->validate([
            'id_gunung' => 'nullable|exists:gunung,id',
            'nama' => 'required|string|max:60',
            'province_id' => 'required|size:2',
            'regency_id' => 'required|size:4',
            'district_id' => 'required|size:7',
            'village_id' => 'required|size:10',
            'deskripsi' => 'required|string',
            'map_basecamp' => 'required|string|max:60',
            'biaya' => 'required|integer',
        ]);

        $jalur->update($request->all());
        return redirect()->route('jalur.index')->with('success', 'Jalur berhasil diupdate');
    }

    public function destroy(Jalur $jalur)
    {
        $jalur->delete();
        return redirect()->route('jalur.index')->with('success', 'Jalur berhasil dihapus');
    }
}
