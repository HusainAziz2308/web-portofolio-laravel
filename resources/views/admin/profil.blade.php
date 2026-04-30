<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Konten Portofolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Informasi Hero Section') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Ganti teks yang muncul di bagian paling atas website kamu.") }}
                        </p>
                    </header>

                    {{-- Notifikasi Berhasil --}}
                    @if (session('status'))
                        <div class="mt-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.profil.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $profile->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Hero Title --}}
                        <div>
                            <x-input-label for="hero_title" :value="__('Hero Title (Tagline)')" />
                            <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full" :value="old('hero_title', $profile->hero_title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('hero_title')" />
                        </div>

                        {{-- Hero Subtitle --}}
                        <div>
                            <x-input-label for="hero_subtitle" :value="__('Hero Subtitle (Deskripsi Singkat)')" />
                            <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('hero_subtitle')" />
                        </div>

                        {{-- About Text --}}
                        <div>
                            <x-input-label for="about_text" :value="__('Tentang Saya (Bio Lengkap)')" />
                            <textarea id="about_text" name="about_text" rows="5"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('about_text', $profile->about_text) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('about_text')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
