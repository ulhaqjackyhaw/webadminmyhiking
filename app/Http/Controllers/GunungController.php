<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;

class GunungController extends Controller
{
    public function index()
    {
        $gunungs = Gunung::all();
        return view('gunung.index', compact('gunungs'));
    }

    public function create()
    {
        return view('gunung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|integer',
            'regency_id' => 'required|integer',
            'district_id' => 'required|integer',
            'village_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketinggian' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gunung_images', 'public');
        }

        Gunung::create($data);

        return redirect()->route('gunung.index')->with('success', 'Gunung berhasil ditambahkan!');
    }

    public function show($id)
    {
        $gunung = Gunung::findOrFail($id); // Mengambil data gunung berdasarkan ID
        return view('gunung.show', compact('gunung'));
    }


    public function edit(Gunung $gunung)
    {
        return view('gunung.edit', compact('gunung'));
    }

    public function update(Request $request, Gunung $gunung)
    {
        $request->validate([
            'province_id' => 'required|integer',
            'regency_id' => 'required|integer',
            'district_id' => 'required|integer',
            'village_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketinggian' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($gunung->gambar) {
                \Storage::disk('public')->delete($gunung->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('gunung_images', 'public');
        }

        $gunung->update($data);

        return redirect()->route('gunung.index')->with('success', 'Gunung berhasil diupdate!');
    }

    public function destroy(Gunung $gunung)
    {
        if ($gunung->gambar) {
            \Storage::disk('public')->delete($gunung->gambar);
        }
        $gunung->delete();

        return redirect()->route('gunung.index')->with('success', 'Gunung berhasil dihapus!');
    }

}
