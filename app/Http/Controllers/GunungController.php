<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;

class GunungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gunungs = Gunung::all();
        return view('gunung.index', compact('gunungs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gunung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|size:2',
            'regency_id' => 'required|size:4',
            'district_id' => 'required|size:7',
            'village_id' => 'required|size:10',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ketinggian' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('images', 'public');

        Gunung::create([
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'ketinggian' => $request->ketinggian,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('gunung.index')->with('success', 'Data gunung berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gunung $gunung)
    {
        return view('gunung.edit', compact('gunung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gunung $gunung)
    {
        $request->validate([
            'province_id' => 'required|size:2',
            'regency_id' => 'required|size:4',
            'district_id' => 'required|size:7',
            'village_id' => 'required|size:10',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ketinggian' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('images', 'public');
            $gunung->gambar = $gambarPath;
        }

        $gunung->update($request->only([
            'province_id',
            'regency_id',
            'district_id',
            'village_id',
            'nama',
            'deskripsi',
            'ketinggian',
        ]));

        return redirect()->route('gunung')->with('success', 'Data gunung berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gunung $gunung)
    {
        $gunung->delete();
        return redirect()->route('gunung')->with('success', 'Data gunung berhasil dihapus.');
    }
}
