<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);
    
            User::create([
                'email' => $validated['email'],
                'role' => 'petugas', 
                'password' => Hash::make($validated['password']),
            ]);
    
            return to_route('users.index')->with('success', 'User berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return to_route('users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return to_route('users.index')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
    
}
