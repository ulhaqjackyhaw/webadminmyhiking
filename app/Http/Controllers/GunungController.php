<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Province; // Import model Provinsi
use App\Models\Regency; // Import model Provinsi
use App\Models\District; // Import model Provinsi
use App\Models\Village; // Import model Provinsi

class GunungController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Query data gunung dengan filter pencarian (jika ada)
        $gunungs = Gunung::with(['province', 'regency', 'district', 'village'])
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')                    
                    ->orWhere('ketinggian', 'like', '%' . $search . '%');                    
            })
            ->get();

        // Tampilkan ke view
        // dd($gunungs);
        return view('gunung.index', compact('gunungs'));
    }

    public function create()
    {
        // Mengambil data untuk dropdown
        $province_id = Province::all(); // Semua data provinsi
        $regency_id = Regency::all();   // Semua data kabupaten
        $district_id = District::all(); // Semua data kecamatan
        $village_id = Village::all();   // Semua data desa
        
        return view('gunung.create', compact('province_id', 'regency_id', 'district_id', 'village_id'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama' => 'required|string|max:255',
            'province_id' => 'required|integer|exists:reg_provinces,id',
            'regency_id' => 'required|integer|exists:reg_regencies,id',
            'district_id' => 'required|integer|exists:reg_districts,id',
            'village_id' => 'required|integer|exists:reg_villages,id',
            'ketinggian' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:1000',
            'gambar_gunung' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar_gunung')) {
            $gambarPath = $request->file('gambar_gunung')->store('gunung', 'public');
        }

        // Simpan data ke database
        Gunung::create([
            'nama' => $request->nama,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'ketinggian' => $request->ketinggian,
            'deskripsi' => $request->deskripsi,
            'gambar_gunung' => $gambarPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('gunung.index')->with('success', 'Gunung berhasil ditambahkan!');
    }

    public function show($id)
    {
        $gunung = Gunung::findOrFail($id); // Mengambil data gunung berdasarkan ID
        return view('gunung.show', compact('gunung'));
    }


    public function edit($id)
{
    // Temukan gunung berdasarkan ID
    $gunung = Gunung::findOrFail($id);

    // Ambil data untuk dropdown (Provinsi, Kabupaten, Kecamatan, Desa)
    $province_id = Province::all();
    $regency_id = Regency::all();
    $district_id = District::all();
    $village_id = Village::all();

    // Tampilkan form edit dengan data gunung dan data untuk dropdown
    return view('gunung.edit', compact('gunung', 'province_id', 'regency_id', 'district_id', 'village_id'));
}


public function update(Request $request, $id)
{
    // Validasi input form
    $request->validate([
        'nama' => 'required|string|max:255',
        'province_id' => 'required|integer|exists:reg_provinces,id',
        'regency_id' => 'required|integer|exists:reg_regencies,id',
        'district_id' => 'required|integer|exists:reg_districts,id',
        'village_id' => 'required|integer|exists:reg_villages,id',
        'ketinggian' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string|max:1000',
        'gambar_gunung' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Temukan gunung berdasarkan ID
    $gunung = Gunung::findOrFail($id);

    // Upload gambar jika ada
    if ($request->hasFile('gambar_gunung')) {
        // Hapus gambar lama jika ada
        if ($gunung->gambar_gunung) {
            \Storage::disk('public')->delete($gunung->gambar_gunung);
        }
    
        // Upload gambar baru
        $gambarPath = $request->file('gambar_gunung')->store('gunung', 'public');
    } else {
        $gambarPath = $gunung->gambar_gunung;
    }

    // Update data gunung
    $gunung->update([
        'nama' => $request->nama,
        'province_id' => $request->province_id,
        'regency_id' => $request->regency_id,
        'district_id' => $request->district_id,
        'village_id' => $request->village_id,
        'ketinggian' => $request->ketinggian,
        'deskripsi' => $request->deskripsi,
        'gambar_gunung' => $gambarPath,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('gunung.index')->with('success', 'Gunung berhasil diperbarui!');
}

    public function destroy($id)
{
    // Temukan gunung berdasarkan ID
    $gunung = Gunung::findOrFail($id);

    // Hapus gambar jika ada
    if ($gunung->gambar_gunung) {
        \Storage::disk('public')->delete($gunung->gambar_gunung);
    }

    // Hapus data gunung
    $gunung->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('gunung.index')->with('success', 'Gunung berhasil dihapus!');
}


}
