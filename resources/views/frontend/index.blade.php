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
                    <a href="#contact"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full font-medium transition shadow-lg shadow-indigo-500/30">
                        Hire Me
                    </a>
                </div>
            </div>

            <div class="relative w-72 h-72 md:w-96 md:h-96 animate-float">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-cyan-400 rounded-full blur-2xl opacity-40">
                </div>

                {{-- Memanggil foto dari database menggunakan helper asset() --}}
                <img src="{{ asset($profile->photo_path) }}" alt="{{ $profile->name }}"
                    class="relative z-10 w-full h-full object-cover rounded-full border-4 border-slate-800 shadow-2xl">
            </div>

        </div>
    </section>

    </section>

    <section id="about" class="py-24 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">

            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-sm text-indigo-500 font-semibold tracking-wide uppercase">Get To Know More</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight sm:text-4xl">
                    About <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Me</span>
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="flex-1 w-full flex justify-center" data-aos="fade-right">
                    <div
                        class="relative w-64 h-64 md:w-80 md:h-80 bg-slate-800 rounded-2xl rotate-3 overflow-hidden shadow-xl border border-slate-700">
                        {{-- Kamu bisa ganti fotonya nanti, kita pakai foto profil sementara --}}
                        <img src="{{ asset($profile->photo_path) }}" alt="About Image"
                            class="w-full h-full object-cover -rotate-3 scale-110 opacity-80 hover:opacity-100 transition duration-500">
                    </div>
                </div>

                <div class="flex-1 w-full text-center md:text-left" data-aos="fade-left">
                    <p class="text-slate-400 text-lg leading-relaxed mb-6">
                        {{ $profile->about_text ?? 'Deskripsi about belum ditambahkan.' }}
                    </p>

                    <div class="flex mt-8 justify-center md:justify-start">
                        {{-- Cek apakah salah satu atau kedua CV sudah di-upload --}}
                        @if ($profile->cv_id || $profile->cv_en)
                            <div class="relative inline-block text-left" x-data="{ open: false }">

                                <button @click="open = !open" type="button"
                                    class="inline-flex items-center justify-center px-6 py-3 border-2 border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded-xl font-medium transition duration-300 shadow-lg shadow-indigo-500/20 focus:outline-none">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <span>Download CV</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" @click.outside="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute left-0 md:left-0 mt-2 w-52 rounded-xl shadow-xl bg-slate-800 border border-slate-700 z-50 overflow-hidden"
                                    style="display: none;">

                                    <div class="py-1 divide-y divide-slate-700/50">
                                        {{-- Pilihan Bahasa Indonesia --}}
                                        @if ($profile->cv_id)
                                            <a href="{{ asset('storage/' . $profile->cv_id) }}" target="_blank"
                                                class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-slate-700 hover:text-indigo-400 transition font-medium">
                                                <span class="mr-2 text-base">🇮🇩</span> Bahasa Indonesia
                                            </a>
                                        @endif

                                        {{-- Pilihan Bahasa Inggris --}}
                                        @if ($profile->cv_en)
                                            <a href="{{ asset('storage/' . $profile->cv_en) }}" target="_blank"
                                                class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400 transition font-medium">
                                                <span class="mr-2 text-base">🇬🇧</span> English Version
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Tampilan jika di control panel belum mengunggah file apapun --}}
                            <p class="text-sm text-slate-500 italic py-3">CV belum tersedia untuk diunduh saat ini.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- Tambahkan activeModal: null pada x-data --}}
    <section id="portfolio" class="py-24 bg-slate-900" x-data="{ activeSkill: 'all', activeModal: null }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-indigo-500 font-bold uppercase tracking-widest text-sm">Portfolio</h2>
                <h3 class="text-4xl font-extrabold text-white">My Creative <span class="text-cyan-400">Works</span></h3>
            </div>

            {{-- Filter Buttons --}}
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button @click="activeSkill = 'all'"
                    :class="activeSkill === 'all' ? 'bg-indigo-600 text-white' : 'bg-slate-800 text-slate-400'"
                    class="px-6 py-2 rounded-full transition duration-300">All</button>
                @foreach ($skills as $skill)
                    <button @click="activeSkill = '{{ $skill->id }}'"
                        :class="activeSkill === '{{ $skill->id }}' ? 'bg-indigo-600 text-white' :
                            'bg-slate-800 text-slate-400'"
                        class="px-6 py-2 rounded-full transition duration-300">{{ $skill->name }}</button>
                @endforeach
            </div>

            {{-- Grid Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    {{-- KARTU PROJECT --}}
                    <div x-show="activeSkill === 'all' || activeSkill === '{{ $project->skill_id }}'"
                        @click="activeModal = {{ $project->id }}"
                        class="group relative bg-slate-800 rounded-2xl overflow-hidden border border-slate-700 shadow-2xl cursor-pointer hover:border-indigo-500 transition duration-300">

                        <div class="h-56 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $project->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-300">
                                <span class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium">Lihat
                                    Detail</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="text-xs text-indigo-400 font-bold uppercase">{{ $project->skill->name }}</span>
                            <h4 class="text-xl font-bold text-white mt-1">{{ $project->title }}</h4>
                        </div>
                    </div>

                    {{-- MODAL DETAIL KARYA (Hanya muncul saat kartu diklik) --}}
                    <div x-show="activeModal === {{ $project->id }}" style="display: none;"
                        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">

                        {{-- Background Overlay Hitam --}}
                        <div @click="activeModal = null" x-show="activeModal === {{ $project->id }}"
                            x-transition.opacity class="absolute inset-0 bg-slate-900/90 backdrop-blur-sm"></div>

                        {{-- Konten Modal --}}
                        <div x-show="activeModal === {{ $project->id }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="relative bg-slate-800 border border-slate-700 w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl z-10">

                            {{-- Header Modal: Tombol Kembali di Kiri --}}
                            <div
                                class="sticky top-0 bg-slate-800/95 backdrop-blur border-b border-slate-700 p-4 flex items-center justify-between z-20">
                                <button @click="activeModal = null"
                                    class="flex items-center text-slate-400 hover:text-indigo-400 transition font-medium">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Kembali
                                </button>
                            </div>

                            {{-- Body Modal --}}
                            <div class="p-6 sm:p-8">
                                <span
                                    class="text-sm text-indigo-400 font-bold uppercase tracking-wider">{{ $project->skill->name }}</span>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-2 mb-6">{{ $project->title }}
                                </h2>

                                {{-- Foto Banner di Dalam Modal --}}
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}"
                                        class="w-full rounded-xl mb-8 border border-slate-700">
                                @endif

                                {{-- Deskripsi --}}
                                <div class="prose prose-invert max-w-none text-slate-300 mb-8">
                                    <p class="whitespace-pre-line">{{ $project->description }}</p>
                                </div>

                                {{-- Tombol Link --}}
                                <div class="flex flex-wrap gap-4 mt-8 pt-6 border-t border-slate-700">
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank"
                                            class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition shadow-lg shadow-indigo-500/20">
                                            Kunjungi Web / Project
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($project->video_url)
                                        <a href="{{ $project->video_url }}" target="_blank"
                                            class="inline-flex items-center justify-center px-6 py-3 border border-red-500 text-red-400 hover:bg-red-500 hover:text-white rounded-xl font-medium transition shadow-lg">
                                            Tonton Video
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
