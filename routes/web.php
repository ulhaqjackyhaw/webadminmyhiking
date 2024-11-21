<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\JalurController;
use App\Http\Controllers\WilayahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Rute untuk daftar gunung
Route::get('/gunung', [GunungController::class, 'index'])->name('gunung');

// Resource route tanpa index
Route::resource('gunung', GunungController::class)->except(['index']);
// Route::resource('gunung', GunungController::class);
Route::resource('jalur', JalurController::class);

Route::get('/get-regencies/{province_id}', [WilayahController::class, 'getRegencies']);
Route::get('/get-districts/{regency_id}', [WilayahController::class, 'getDistricts']);
Route::get('/get-villages/{district_id}', [WilayahController::class, 'getVillages']);

Route::get('/jalur/{id}/edit', [JalurController::class, 'edit'])->name('jalur.edit');
Route::put('/jalur/{id}', [JalurController::class, 'update'])->name('jalur.update');
