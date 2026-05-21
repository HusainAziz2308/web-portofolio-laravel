<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class CvController extends Controller
{
    // Menampilkan halaman kelola CV
    public function index()
    {
        // Mengambil data profil pertama (karena ini web portofolio pribadi)
        $profile = Profile::first() ?? new Profile();

        return view('admin.cv.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_id_upload' => 'nullable|file|mimes:pdf|max:10240', // Maks 10MB, hanya PDF
            'cv_en_upload' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $profile = Profile::first();
        if (!$profile) {
            // Jika data profil belum ada sama sekali di database, buat baru
            $profile = Profile::create([]);
        }

        // Handle CV Bahasa Indonesia
        if ($request->hasFile('cv_id_upload')) {
            // Hapus file lama jika ada
            if ($profile->cv_id && Storage::disk('public')->exists($profile->cv_id)) {
                Storage::disk('public')->delete($profile->cv_id);
            }
            $profile->cv_id = $request->file('cv_id_upload')->store('cv_files', 'public');
        }

        // Handle CV Bahasa Inggris
        if ($request->hasFile('cv_en_upload')) {
            // Hapus file lama jika ada
            if ($profile->cv_en && Storage::disk('public')->exists($profile->cv_en)) {
                Storage::disk('public')->delete($profile->cv_en);
            }
            $profile->cv_en = $request->file('cv_en_upload')->store('cv_files', 'public');
        }

        $profile->save();

        return redirect()->route('admin.cv.index')->with('status', 'Dokumen CV berhasil diperbarui!');
    }

    // Menghapus spesifik file CV
    public function destroy($type)
    {
        $profile = Profile::first();

        if (!$profile) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        // Jika user klik hapus CV Bahasa Indonesia
        if ($type === 'id' && $profile->cv_id) {
            if (Storage::disk('public')->exists($profile->cv_id)) {
                Storage::disk('public')->delete($profile->cv_id);
            }
            $profile->cv_id = null;
        }

        // Jika user klik hapus CV Bahasa Inggris
        elseif ($type === 'en' && $profile->cv_en) {
            if (Storage::disk('public')->exists($profile->cv_en)) {
                Storage::disk('public')->delete($profile->cv_en);
            }
            $profile->cv_en = null;
        }

        $profile->save();

        return redirect()->route('admin.cv.index')->with('status', 'File CV berhasil dihapus!');
    }
}
