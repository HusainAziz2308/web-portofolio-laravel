<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Karya Portofolio') }}
            </h2>

            @if($totalSkills > 0)
                {{-- Tombol Normal jika sudah ada skill --}}
                <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium transition">
                    + Tambah Karya Baru
                </a>
            @else
                {{-- Tombol Mengarah ke Tambah Skill jika belum ada skill --}}
                <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-sm font-medium transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Buat Bidang Skill Dulu
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4">Karya / Project</th>
                            <th scope="col" class="px-6 py-4">Bidang Skill</th>
                            <th scope="col" class="px-6 py-4 text-center">Tautan</th>
                            <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <div class="flex items-center gap-3">
                                        @if ($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}"
                                                class="w-10 h-10 rounded object-cover">
                                        @endif
                                        {{ $project->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $project->skill->name }}</td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank"
                                            class="text-indigo-500 hover:underline"><i class="fas fa-link"></i></a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                        class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>

                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus karya ini?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-medium bg-none border-none p-0 cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center italic text-gray-500">Belum ada karya.
                                    Klik "+ Tambah Karya Baru" di atas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
