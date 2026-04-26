@extends('frontend.layouts.main')

@section('content')
{{-- Hero Section --}}
<section class="py-20 px-6">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text 5xl md:text-6xl font-extrabold text-slate-900 mb-6">
            Halo, I'M <span class="text-indigo-600">Aziz Husain</span>
        </h1>
        <p class="text-xl text-slate-600 mb-8">
            Mahasiswa Sistem Informasi Frontend Specialist
        </p>
        <div class="flex justify-center space-x-4">
            <a href="/projects" class="bg-indigo-600 text-white px-8 py-3 rounded-md hover:bg-indigo-700 transition">View Projects</a>
            <a href="/contact" class="bg-white text-indigo-600 border border-indigo-600 px-8 py-3 rounded-md hover:bg-indigo-100 transition">Contact Me</a>
        </div>
    </div>
</section>
@endsection
