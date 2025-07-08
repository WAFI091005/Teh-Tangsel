<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all(); // Ambil semua user

        // Hitung jumlah user per role (admin, user, dll)
        $userCounts = User::selectRaw('role, COUNT(*) as count')
                        ->groupBy('role')
                        ->pluck('count', 'role');

        return view('pengguna', compact('users', 'userCounts'));
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Kalau kamu mau mencegah hapus admin misalnya:
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin tidak boleh dihapus.');
        }

        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }


}
