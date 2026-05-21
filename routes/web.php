<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\CvController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profile = Profile::first();
    // Ambil semua bidang skill
    $skills = Skill::all();

    // Ambil semua karya beserta data bidangnya (Eager Loading biar efisien)
    $projects = Project::with('skill')->get();

    // Kirim semua variabel ke halaman depan
    return view('frontend.index', compact('profile', 'skills', 'projects'));
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Halaman Utama Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Control Panel Portofolio
    Route::get('/admin/profil', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::patch('/admin/profil', [ProfilController::class, 'update'])->name('admin.profil.update');

    // Rute khusus untuk Foto Hero
    Route::post('/admin/profil/image', [ProfileController::class, 'updateImage'])->name('admin.profil.image.update');
    Route::delete('/admin/profil/image', [ProfileController::class, 'destroyImage'])->name('admin.profil.image.destroy');

    // Rute Kelola CV
    Route::get('/admin/cv', [CvController::class, 'index'])->name('admin.cv.index');
    Route::post('/admin/cv', [CvController::class, 'update'])->name('admin.cv.update');
    Route::delete('/admin/cv/{type}', [CvController::class, 'destroy'])->name('admin.cv.destroy');

    Route::get('/admin/skills', [SkillController::class, 'index'])->name('admin.skills.index');
    Route::get('/admin/skills/create', [SkillController::class, 'create'])->name('admin.skills.create');
    Route::post('/admin/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::get('/admin/skills/{skill}/edit', [SkillController::class, 'edit'])->name('admin.skills.edit');
    Route::put('/admin/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    Route::delete('/admin/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');

    // Rute CRUD Projects
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/admin/projects', [ProjectController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/admin/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/admin/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
});

require __DIR__ . '/auth.php';
