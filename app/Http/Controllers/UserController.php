<?php

namespace App\Http\Controllers;

use App\Models\User; // Import model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan semua data user (id, nama, email).
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    // Ambil keyword pencarian dari parameter 'search'
    $search = $request->get('search');

    // Query untuk mencari data user berdasarkan name atau email
    $users = User::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->select('id', 'name', 'email')
        ->get(); // Ambil semua data setelah filter

    // Kirim data ke view 'users.index'
    return view('users.index', compact('users'));
}

    /**
     * Tampilkan detail data user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cari data user berdasarkan id
        $user = User::findOrFail($id);

        // Kirim data ke view 'users.show'
        return view('users.show', compact('user'));
    }
}
