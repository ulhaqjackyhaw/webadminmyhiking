<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Gunung;
use App\Models\Jalur;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menghitung data yang diperlukan
        $totalTransaksi = Transaksi::count(); // Hitung semua transaksi
        $totalGunung = Gunung::count(); // Hitung jumlah gunung
        $totalJalur = Jalur::count(); // Hitung jumlah jalur
        $totalUser = User::count(); // Hitung jumlah user

        // Mengirim data ke view
        return view('home', compact('totalTransaksi', 'totalGunung', 'totalJalur', 'totalUser'));
    }
}
