<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Bidang/Skill') }}
            </h2>
            <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium transition">
                + Tambah Skill Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nama Bidang Skill</th>
                            <th scope="col" class="px-6 py-4 text-center">Jumlah Karya</th>
                            <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $skill->name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $skill->projects_count }} Karya
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.skills.edit', $skill->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>

                                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus bidang ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium bg-none border-none p-0 cursor-pointer">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center italic text-gray-500">Belum ada data bidang/skill.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
