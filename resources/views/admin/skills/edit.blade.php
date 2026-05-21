<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.skills.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Bidang Skill') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('admin.skills.update', $skill->id) }}" class="space-y-6">
                    @csrf
                    @method('put')
                    <div>
                        <x-input-label for="name" :value="__('Nama Bidang')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $skill->name)" required autofocus autocomplete="off" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Perbarui Bidang') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
