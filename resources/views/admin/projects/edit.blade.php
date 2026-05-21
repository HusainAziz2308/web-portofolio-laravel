<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Karya: ') }} {{ $project->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form method="post" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('put') {{-- WAJIB untuk rute PUT/PATCH update data --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Pilih Kategori Skill --}}
                        <div>
                            <x-input-label for="skill_id" :value="__('Pilih Bidang Skill')" />
                            <select id="skill_id" name="skill_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Bidang --</option>
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id', $project->skill_id) == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('skill_id')" />
                        </div>

                        {{-- Judul Karya --}}
                        <div>
                            <x-input-label for="title" :value="__('Judul Karya / Project')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required :value="old('title', $project->title)" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                    </div>

                    {{-- Deskripsi Project --}}
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $project->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Upload Banner/Foto Mockup --}}
                    <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                        <x-input-label for="image" :value="__('Ganti Foto / Mockup Preview (Kosongkan jika tidak diganti)')" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />

                        {{-- Menampilkan Gambar yang Sedang Aktif Sekarang --}}
                        @if($project->image)
                            <div class="mt-4">
                                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-2">Foto Saat Ini:</span>
                                <img src="{{ asset('storage/' . $project->image) }}" class="w-40 h-24 object-cover rounded-md border shadow-sm">
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Link Embed Video --}}
                        <div>
                            <x-input-label for="video_url" :value="__('Link Video (YouTube/Drive)')" />
                            <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full" :value="old('video_url', $project->video_url)" placeholder="https://youtube.com/watch?v=..." />
                            <x-input-error class="mt-2" :messages="$errors->get('video_url')" />
                        </div>

                        {{-- Link Live Project --}}
                        <div>
                            <x-input-label for="project_url" :value="__('Link Live Project / GitHub')" />
                            <x-text-input id="project_url" name="project_url" type="url" class="mt-1 block w-full" :value="old('project_url', $project->project_url)" placeholder="https://github.com/username/repo" />
                            <x-input-error class="mt-2" :messages="$errors->get('project_url')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>{{ __('Perbarui Karya') }}</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
