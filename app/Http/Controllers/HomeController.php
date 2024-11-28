<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Gunung;
use App\Models\Jalur;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaksi::count(); // Hitung semua transaksi
        $totalGunung = Gunung::count(); // Hitung jumlah gunung
        $totalJalur = Jalur::count(); // Hitung jumlah jalur
        $totalUser = User::count(); // Hitung jumlah user

        return view('home', compact('totalTransaksi', 'totalGunung', 'totalJalur', 'totalUser'));
    }
}
