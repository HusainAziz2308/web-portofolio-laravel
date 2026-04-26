<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio Husain Aziz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    {{-- Navbar --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px4 sm:px-6 lg:px-8">
            <div class="font-bold text 2xl text indigo-600">Husain.dev</div>
            <div class="hiddem md:flex space-x-8 font-medium">
                <a href="/" class="text-gray-700 hover:text-indigo-600">Home</a>
                <a href="/about" class="text-gray-700 hover:text-indigo-600">About</a>
                <a href="/projects" class="text-gray-700 hover:text-indigo-600">Projects</a>
            </div>
            <div>
                <a href="{{ route('login') }}" class="text-sm text bg-slate-400 hover:bg-slate-600">Login</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 py-12 mt-20">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} Husain Aziz. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
