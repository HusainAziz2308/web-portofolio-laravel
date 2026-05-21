<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        // Mengambil data profil pertama (hasil seeder tadi)
        $profile = Profile::first();
        return view('admin.profil', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'about_text' => 'nullable|string',
        ]);

        // Update hanya menggunakan data yang sudah divalidasi
        $profile->update($validated);

        return redirect()->back()->with('status', 'Data portofolio & CV berhasil diperbarui!');
    }

    // Fungsi Upload / Replace Gambar
    public function updateImage(Request $request)
    {
        $request->validate([
            'photo_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Maksimal 5MB
        ]);

        $profile = Profile::first();

        // 1. Hapus gambar lama dari storage jika sebelumnya sudah ada
        if ($profile->photo_path && Storage::disk('public')->exists($profile->photo_path)) {
            Storage::disk('public')->delete($profile->photo_path);
        }

        // 2. Simpan gambar baru
        $profile->photo_path = $request->file('photo_path')->store('photo_paths', 'public');
        $profile->save();

        return redirect()->back()->with('status-image', 'Foto profil berhasil diperbarui!');
    }

    // Fungsi Hapus Murni (Delete)
    public function destroyImage()
    {
        $profile = Profile::first();

        // Cek dan hapus file fisik di storage
        if ($profile->photo_path && Storage::disk('public')->exists($profile->photo_path)) {
            Storage::disk('public')->delete($profile->photo_path);

            // Kosongkan nama file di database
            $profile->photo_path = null;
            $profile->save();
        }

        return redirect()->back()->with('status-image', 'Foto profil berhasil dihapus!');
    }
}
