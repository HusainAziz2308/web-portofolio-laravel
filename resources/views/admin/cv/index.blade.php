<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Dokumen CV') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Upload Curriculum Vitae</h3>
                    <p class="mt-1 text-sm text-gray-600">Unggah file CV terbaru dalam format PDF. Kamu bisa menyediakan versi Bahasa Indonesia dan Bahasa Inggris.</p>
                </header>

                {{-- FORM UTAMA: Hanya untuk Upload / Update --}}
                <form method="post" action="{{ route('admin.cv.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- CV Bahasa Indonesia --}}
                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                            <x-input-label for="cv_id_upload" :value="__('Upload CV (Bahasa Indonesia)')" />
                            <input id="cv_id_upload" name="cv_id_upload" type="file" accept=".pdf"
                                class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('cv_id_upload')" />

                            @if ($profile->cv_id)
                                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded text-sm text-green-700 font-medium flex justify-between items-center">
                                    <span>✓ CV (ID) Aktif</span>
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $profile->cv_id) }}" target="_blank" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">Lihat File</a>

                                        {{-- Tombol ini memicu form di luar menggunakan id 'form-hapus-id' --}}
                                        <button type="submit" form="form-hapus-id" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition border-none cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="mt-4 text-sm text-red-500 font-medium">⚠ Belum ada CV (ID) yang diunggah.</p>
                            @endif
                        </div>

                        {{-- CV Bahasa Inggris --}}
                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                            <x-input-label for="cv_en_upload" :value="__('Upload CV (Bahasa Inggris)')" />
                            <input id="cv_en_upload" name="cv_en_upload" type="file" accept=".pdf"
                                class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('cv_en_upload')" />

                            @if ($profile->cv_en)
                                <div class="mt-4 p-3 bg-cyan-50 border border-cyan-200 rounded text-sm text-cyan-800 font-medium flex justify-between items-center">
                                    <span>✓ CV (EN) Aktif</span>
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $profile->cv_en) }}" target="_blank" class="px-3 py-1 bg-cyan-600 text-white rounded hover:bg-cyan-700 transition">Lihat File</a>

                                        {{-- Tombol ini memicu form di luar menggunakan id 'form-hapus-en' --}}
                                        <button type="submit" form="form-hapus-en" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition border-none cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="mt-4 text-sm text-red-500 font-medium">⚠ Belum ada CV (EN) yang diunggah.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex items-center gap-4 border-t pt-6">
                        <x-primary-button>{{ __('Simpan Dokumen') }}</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- FORM HAPUS MANDIRI (Ditaruh di luar form utama agar tidak tabrakan) --}}
    @if ($profile->cv_id)
        <form id="form-hapus-id" action="{{ route('admin.cv.destroy', ['type' => 'id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen CV Bahasa Indonesia?')" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    @if ($profile->cv_en)
        <form id="form-hapus-en" action="{{ route('admin.cv.destroy', ['type' => 'en']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen CV Bahasa Inggris?')" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-app-layout>
