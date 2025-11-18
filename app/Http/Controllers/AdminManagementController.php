<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    public function index()
    {
        // Implementasi untuk menampilkan daftar admin
    }

    public function create()
    {
        // Implementasi untuk menampilkan form tambah admin
    }

    public function store(Request $request)
    {
        // Implementasi untuk menyimpan data admin baru
    }

    public function edit($id)
    {
        // Implementasi untuk menampilkan form edit admin
    }

    public function update(Request $request, $id)
    {
        // Implementasi untuk menyimpan perubahan data admin
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Cek jika user mencoba menghapus dirinya sendiri
            if (auth()->user()->id === $user->id) {
                return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            }

            $user->delete();
            return redirect()->route('admin.management')->with('success', 'Admin berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus admin.');
        }
    }
} 