<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        // withCount untuk menghitung jumlah karya di tiap bidang
        $skills = Skill::withCount('projects')->latest()->get();
        return view('admin.skills.index', compact('skills'));
    }

    // 2. Menampilkan Form Tambah
    public function create()
    {
        return view('admin.skills.create');
    }

    // 3. Memproses Simpan Bidang Baru
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Skill::create(['name' => $request->name]);

        return redirect()->route('admin.skills.index')->with('status', 'Bidang Skill berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    // 5. Memproses Perubahan Data
    public function update(Request $request, Skill $skill)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $skill->update(['name' => $request->name]);

        return redirect()->route('admin.skills.index')->with('status', 'Bidang Skill berhasil diperbarui!');
    }

    // 6. Menghapus Bidang
    public function destroy(Skill $skill)
    {
        // PENCEGAHAN: Jangan hapus kalau masih ada karya di dalamnya
        if ($skill->projects()->count() > 0) {
            return redirect()->route('admin.skills.index')->with('error', 'Gagal dihapus! Bidang ini masih memiliki karya. Hapus karyanya terlebih dahulu.');
        }

        $skill->delete();

        return redirect()->route('admin.skills.index')->with('status', 'Bidang Skill berhasil dihapus!');
    }
}
