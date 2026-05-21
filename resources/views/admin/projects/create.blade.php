<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}"
                class="text-gray-500 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Karya Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Notifikasi Error/Peringatan jika lompat rute --}}
            @if (session('error'))
                <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg font-medium border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Notifikasi Sukses --}}
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="space-y-6">
                    {{-- Daftar Skill yang Sudah Ada --}}
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h3 class="text-md font-medium text-gray-900 mb-4">Daftar Bidang Saat Ini</h3>
                        @if ($skills->isEmpty())
                            <p class="text-sm text-gray-500 italic">Belum ada Bidang/Skill.</p>
                        @else
                            <ul class="divide-y divide-gray-200">
                                @foreach ($skills as $skill)
                                    <li class="py-3 flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-700">{{ $skill->name }}</span>
                                        <span
                                            class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $skill->projects->count() }} Karya
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <header>
                            <h3 class="text-lg font-medium text-gray-900 ">Upload Karya Baru</h3>
                            <p class="mt-1 text-sm text-gray-600 ">Pamerkan project codingan, foto, atau video
                                dokumentermu di sini.</p>
                        </header>

                        <form method="post" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data"
                            class="mt-6 space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Pilih Kategori Skill --}}
                                <div>
                                    <x-input-label for="skill_id" :value="__('Pilih Bidang Skill')" />
                                    <select id="skill_id" name="skill_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required>
                                        <option value="">-- Pilih Bidang --</option>
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('skill_id')" />
                                </div>

                                {{-- Judul Karya --}}
                                <div>
                                    <x-input-label for="title" :value="__('Judul Karya / Project')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                        required placeholder="Misal: Aplikasi E-Commerce Apotek" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>
                            </div>

                            {{-- Deskripsi Project --}}
                            <div>
                                <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                                <textarea id="description" name="description" rows="3"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Jelaskan tech stack atau detail dari karya ini..."></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Upload Banner/Foto --}}
                            <div>
                                <x-input-label for="image" :value="__('Foto / Mockup Preview (Maks 5MB)')" />
                                <input id="image" name="image" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Link Embed Video --}}
                                <div>
                                    <x-input-label for="video_url" :value="__('Link Video (YouTube/Drive)')" />
                                    <x-text-input id="video_url" name="video_url" type="url"
                                        class="mt-1 block w-full" placeholder="https://youtube.com/watch?v=..." />
                                    <x-input-error class="mt-2" :messages="$errors->get('video_url')" />
                                </div>

                                {{-- Link Live Project --}}
                                <div>
                                    <x-input-label for="project_url" :value="__('Link Live Project / GitHub')" />
                                    <x-text-input id="project_url" name="project_url" type="url"
                                        class="mt-1 block w-full" placeholder="https://github.com/username/repo" />
                                    <x-input-error class="mt-2" :messages="$errors->get('project_url')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan Karya') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
