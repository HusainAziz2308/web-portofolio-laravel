<?php

use App\Http\Controllers\ProfileController;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profile = Profile::first();
    return view('frontend.index', compact('profile'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
