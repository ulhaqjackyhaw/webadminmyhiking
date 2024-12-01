<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan; // Pastikan model Pesanan sudah ada
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Menampilkan semua transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::all(); // Mengambil semua transaksi
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Menampilkan rincian transaksi berdasarkan ID
     */
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Verifikasi transaksi
     */
    // Controller (TransaksiController.php)

    // Controller untuk memverifikasi transaksi
        public function verify($id)
        {
            $transaksi = Transaksi::findOrFail($id);
            
            // Periksa apakah status pesanan adalah 'unverified'
            if ($transaksi->status_pesanan === 'unverified') {
                $transaksi->status_pesanan = 'verified';  // Ubah status menjadi 'verified'
                $transaksi->save();
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diverifikasi');
        }

    // Controller untuk menambah transaksi baru
    public function store(Request $request)
    {
        $transaksi = new Transaksi;
        $transaksi->id_pesanan = $request->id_pesanan;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->status_pesanan = 'unverified';  // Status default untuk transaksi baru
    
        // Debugging
        dd($transaksi); // Cek apakah status pesanan benar-benar 'unverified'
    
        $transaksi->save();
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }
    


}