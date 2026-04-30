<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfilController;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profile = Profile::first();
    return view('frontend.index', compact('profile'));
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Halaman Utama Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Control Panel Portofolio
    Route::get('/admin/profil', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::patch('/admin/profil', [ProfilController::class, 'update'])->name('admin.profil.update');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
