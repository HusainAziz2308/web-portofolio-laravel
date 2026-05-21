<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $skills = Skill::with('projects')->get();

        $projects = Project::with('skill')->latest()->get();

        $totalSkills = Skill::count();

        return view('admin.projects.index', compact('skills', 'projects', 'totalSkills'));
    }

    public function create()
    {
        $skills = Skill::all();

        // JIKA BIDANG SKILL MASIH KOSONG:
        if ($skills->isEmpty()) {
            return redirect()->route('admin.skills.create')
                ->with('error', 'Silakan buat minimal satu Bidang Skill terlebih dahulu sebelum menambahkan karya baru!');
        }

        $totalSkills = Skill::count();
        return view('admin.projects.create', compact('skills', 'totalSkills'));
    }

    public function edit(Project $project)
    {
        $skills = Skill::all();
        return view('admin.projects.edit', compact('project', 'skills'));
    }

    // Simpan Bidang/Skill baru
    public function storeSkill(Request $request)
    {
        $request->validate(['name' => 'required']);
        Skill::create($request->all());
        return back()->with('status', 'Bidang skill berhasil ditambah!');
    }

    // Simpan Karya/Project baru
    public function storeProject(Request $request)
    {
        $request->validate([
            'skill_id' => 'required',
            'title' => 'required',
            'image' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('project_images', 'public');
        }

        Project::create($data);
        return back()->with('status', 'Karya baru berhasil ditambahkan!');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120', // Maks 5MB sesuai form milikmu
            'video_url' => 'nullable|url',
            'project_url' => 'nullable|url',
        ]);

        // Jika user mengunggah foto preview baru
        if ($request->hasFile('image')) {
            // Hapus foto lama dari storage fisik jika sebelumnya ada
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }

            // Simpan foto baru ke folder storage/app/public/project_images
            $validated['image'] = $request->file('image')->store('project_images', 'public');
        }

        // Perbarui data di database
        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Karya portofolio berhasil diperbarui!');
    }

    // 2. Menghapus Karya (Destroy)
    public function destroy(Project $project)
    {
        // Hapus file gambarnya terlebih dahulu dari server agar tidak memakan ruang penyimpanan
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        // Hapus data dari tabel database
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Karya berhasil dihapus secara permanen!');
    }
}
