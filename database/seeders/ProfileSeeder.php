<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'name'          => 'Aziz Husain',
            'hero_title'    => 'Full-stack Web Developer',
            'hero_subtitle' => 'Mahasiswa Sistem Informasi Semester 4 yang berfokus pada pengembangan web menggunakan Laravel serta memiliki gairah di bidang komunikasi visual.',
            'photo_path'    => 'images/profile-hero.png', // Nama file dummy dulu
            'about_text'    => 'Halo! Saya Husain. Saya spesialis dalam pengembangan full-stack web dan sangat menyukai dunia fotografi, videografi, serta desain grafis.',
        ]);
    }
}
