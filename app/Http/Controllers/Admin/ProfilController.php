<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
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

        return redirect()->back()->with('status', 'Profil berhasil diperbarui!');
    }
}
