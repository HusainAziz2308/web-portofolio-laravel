<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Daftar kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'hero_title',
        'hero_subtitle',
        'about_text',
        'cv_id',
        'cv_en',
    ];
}
