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
        $pesanan = Pesanan::with('anggotaPesanan')->findOrFail($id);
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

public function scan(Request $request)
{
    \Log::info('Scan request received', $request->all());

    $id = $request->input('id');
    $pesanan = Pesanan::find($id);

    if (!$pesanan) {
        \Log::error("Pesanan dengan ID {$id} tidak ditemukan");
        return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan']);
    }

    \Log::info("Pesanan ditemukan dengan status {$pesanan->status}");

    switch ($pesanan->status) {
        case 'Booking':
            $pesanan->status = 'Sedang Mendaki';
            break;
        case 'Sedang Mendaki':
            $pesanan->status = 'Selesai';
            break;
        default:
            \Log::warning("Status {$pesanan->status} tidak dikenali");
            return response()->json(['success' => false, 'message' => 'Status tidak dapat diperbarui lebih lanjut']);
    }

    $pesanan->save();
    \Log::info("Status pesanan berhasil diperbarui menjadi {$pesanan->status}");

    return response()->json(['success' => true]);
}


}

