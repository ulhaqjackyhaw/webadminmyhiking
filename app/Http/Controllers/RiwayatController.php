<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\AnggotaPesanan;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Menampilkan daftar riwayat pesanan
    public function index(Request $request)
{
    $query = Pesanan::select('id', 'tanggal_naik', 'tanggal_turun', 'status')
        ->with('anggotaPesanan:id_users');

    // Filter berdasarkan ID jika ada parameter search
    if ($request->has('search')) {
        $query->where('id', $request->input('search'));
    }

    $riwayatPesanan = $query->get();

    return view('riwayat.index', compact('riwayatPesanan'));
}

    // Menampilkan detail pesanan dan anggota pesanan
    public function show($id)
{
    // Ambil pesanan berdasarkan ID dengan relasi anggotaPesanan
    $pesanan = Pesanan::with('anggotaPesanan')->findOrFail($id);

    // Kirim data pesanan ke view
    return view('riwayat.show', compact('pesanan'));
}


    // Mengupdate status pesanan
    public function updateStatus(Request $request, $id)
{
    $pesanan = Pesanan::findOrFail($id);
    $pesanan->status = $request->input('status'); // Ambil status baru dari tombol
    $pesanan->save();

    return redirect()->route('riwayat.show', $id)->with('success', 'Status pesanan berhasil diperbarui!');
}
    public function scan()
{
    return view('index');
}

}
