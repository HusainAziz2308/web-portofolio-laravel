<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Konten Portofolio') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- GRID LAYOUT: Membagi ruang secara efisien (Kiri: Teks, Kanan: Foto) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- ========================================== --}}
                {{-- KOLOM KIRI: FORM INFORMASI TEKS (2 KOLOM)  --}}
                {{-- ========================================== --}}
                <div class="lg:col-span-2 p-6 bg-white shadow-sm border border-gray-100 rounded-xl">
                    <header class="border-b border-gray-100 pb-4 mb-5">
                        <h2 class="text-base font-bold text-gray-900">
                            {{ __('Informasi Utama Hero Section & Bio') }}
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ __('Kelola konten tekstual yang akan langsung menyapa pengunjung website kamu.') }}
                        </p>
                    </header>

                    {{-- Notifikasi Sukses Update Teks --}}
                    @if (session('status'))
                        <div class="mb-4 font-medium text-xs text-green-700 bg-green-50 p-3 rounded-lg border border-green-200">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.profil.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        {{-- Input: Nama Lengkap --}}
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-semibold text-gray-700" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                :value="old('name', $profile->name)" required autofocus />
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('name')" />
                        </div>

                        {{-- Input: Hero Title --}}
                        <div>
                            <x-input-label for="hero_title" :value="__('Hero Title (Tagline)')" class="text-xs font-semibold text-gray-700" />
                            <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                :value="old('hero_title', $profile->hero_title)" required />
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('hero_title')" />
                        </div>

                        {{-- Input: Hero Subtitle --}}
                        <div>
                            <x-input-label for="hero_subtitle" :value="__('Hero Subtitle (Deskripsi Singkat)')" class="text-xs font-semibold text-gray-700" />
                            <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                                class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('hero_subtitle')" />
                        </div>

                        {{-- Input: About Text --}}
                        <div>
                            <x-input-label for="about_text" :value="__('Tentang Saya (Bio Lengkap)')" class="text-xs font-semibold text-gray-700" />
                            <textarea id="about_text" name="about_text" rows="4"
                                class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('about_text', $profile->about_text) }}</textarea>
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('about_text')" />
                        </div>

                        {{-- Tombol Submit Teks --}}
                        <div class="flex items-center justify-end border-t border-gray-100 pt-4 mt-5">
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-xs py-2 px-4 shadow-sm">
                                {{ __('Simpan Perubahan Teks') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                {{-- ========================================== --}}
                {{-- KOLOM KANAN: MANAGEMENT FOTO HERO (1 KOLOM) --}}
                {{-- ========================================== --}}
                <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-xl">
                    <header class="border-b border-gray-100 pb-4 mb-5">
                        <h2 class="text-base font-bold text-gray-900">
                            {{ __('Foto Profile Hero') }}
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ __('Disarankan rasio 1:1 (Square). Maksimal file 5MB.') }}
                        </p>
                    </header>

                    {{-- Notifikasi Sukses Foto --}}
                    @if (session('status-image'))
                        <div class="mb-4 p-2.5 bg-green-50 border border-green-200 text-xs text-green-700 rounded-lg">
                            {{ session('status-image') }}
                        </div>
                    @endif

                    {{-- Komponen Preview Foto Bentuk Bulat Kreatif --}}
                    <div class="mb-6 flex flex-col items-center justify-center p-4 bg-gray-50 border border-dashed border-gray-200 rounded-xl text-center">
                        @if ($profile->photo_path)
                            <div class="relative group">
                                <img src="{{ str_starts_with($profile->photo_path, 'images/') ? asset($profile->photo_path) : asset('storage/' . $profile->photo_path) }}"
                                    alt="Hero Avatar"
                                    class="w-32 h-32 object-cover rounded-full shadow-md border-4 border-white ring-1 ring-gray-200 transition duration-200 group-hover:brightness-90">

                                {{-- Tombol Overlay Hapus Foto pas di-hover --}}
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 rounded-full">
                                    <button type="submit" form="form-delete-hero-image" class="text-[11px] bg-red-600/90 text-white px-3 py-1 rounded-full shadow-md hover:bg-red-700 transition font-medium backdrop-blur-xs">
                                        Hapus Foto
                                    </button>
                                </div>
                            </div>
                            <p class="text-[11px] text-gray-500 mt-2 font-medium">Foto Aktif Berhasil Dimuat</p>
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 mb-2">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-400 italic">Belum ada foto aktif</p>
                        @endif
                    </div>

                    {{-- Form Upload Foto (Terpisah secara mandiri) --}}
                    <form method="post" action="{{ route('admin.profil.image.update') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="photo_path" :value="__('Pilih Gambar Baru')" class="text-xs font-semibold text-gray-700" />
                            <input id="photo_path" name="photo_path" type="file" accept="image/jpeg, image/png, image/webp" required
                                class="mt-1.5 block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-200 rounded-md p-1 bg-gray-50/50" />
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('photo_path')" />
                        </div>

                        <div class="pt-2">
                            <x-primary-button class="w-full justify-center text-xs py-2 bg-gray-800 hover:bg-gray-700 shadow-sm transition">
                                {{ __('Upload Gambar Baru') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- FORM HAPUS FOTO (Tetap aman tersembunyi di luar layout utama) --}}
    @if ($profile->photo_path)
        <form id="form-delete-hero-image" action="{{ route('admin.profil.image.destroy') }}" method="POST" class="hidden" onsubmit="return confirm('Yakin ingin menghapus foto hero ini?');">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-app-layout>
