<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use App\Models\Gunung;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $jalur = Jalur::all();
        return view('jalur.index', compact('jalur'));
    }

    public function create()
    {
        $gunung = Gunung::all();
        return view('jalur.create', compact('gunung'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_gunung' => 'nullable|exists:gunung,id',
            'province_id' => 'required|size:2',
            'regency_id' => 'required|size:4',
            'district_id' => 'required|size:7',
            'village_id' => 'required|size:10',
            'deskripsi' => 'required|string',
            'map_basecamp' => 'required|string|max:60',
            'biaya' => 'required|integer',
        ]);

        Jalur::create($request->all());
        return redirect()->route('jalur.index')->with('success', 'Jalur berhasil ditambahkan');
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
