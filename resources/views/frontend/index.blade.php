@extends('frontend.layouts.main')

@section('content')
<section id="home" class="min-h-screen flex items-center pt-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full flex flex-col md:flex-row items-center justify-between gap-12">

        <!-- Teks Dinamis dari Database -->
        <div class="flex-1 text-center md:text-left" data-aos="fade-right">
            <h3 class="text-indigo-500 font-semibold tracking-widest mb-2 uppercase">Hello, I'm</h3>

            {{-- Nama dari Database --}}
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                {{ $profile->name ?? 'Husain Aziz' }} <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">
                    {{ $profile->hero_title ?? 'Web Developer' }}
                </span>
            </h1>

            {{-- Subtitle/Bio dari Database --}}
            <p class="text-slate-400 text-lg mb-8 max-w-lg mx-auto md:mx-0">
                {{ $profile->hero_subtitle ?? 'Mahasiswa Sistem Informasi UNIPDU.' }}
            </p>

            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="#contact" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full font-medium transition shadow-lg shadow-indigo-500/30">
                    Hire Me
                </a>
            </div>
        </div>

        <div class="relative w-72 h-72 md:w-96 md:h-96 animate-float">
            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-cyan-400 rounded-full blur-2xl opacity-40"></div>

            {{-- Memanggil foto dari database menggunakan helper asset() --}}
            <img src="{{ asset($profile->photo_path) }}"
                alt="{{ $profile->name }}"
                class="relative z-10 w-full h-full object-cover rounded-full border-4 border-slate-800 shadow-2xl">
        </div>

    </div>
</section>
@endsection