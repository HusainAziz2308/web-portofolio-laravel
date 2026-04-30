<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - {{ $profile->name ?? 'Husain Aziz' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon Dinamis dari Database -->
    <link rel="icon" type="image/x-icon" href="{{ asset($profile->photo_path) }}">
    <!-- 1. Tambahkan CSS AOS untuk animasi scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-slate-900 text-white font-sans antialiased"> <!-- Kita pakai tema gelap biar mirip referensi -->

    <!-- Navbar Transparan & Melayang -->
    <nav class="fixed w-full z-50 bg-transparent backdrop-blur-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex justify-between h-20 items-center">
            <a href="/" class="font-bold text-2xl tracking-wider">{{ $profile->name ?? 'Husain Aziz' }}<span class="text-indigo-500">.</span></a>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#home" class="hover:text-indigo-400 transition">Home</a>
                <a href="#about" class="hover:text-indigo-400 transition">About</a>
                <a href="#projects" class="hover:text-indigo-400 transition">Projects</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- 2. Tambahkan Script AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi animasi
        AOS.init({
            duration: 1000, // Durasi animasi 1 detik
            once: true, // Animasi hanya jalan sekali saat discroll
        });
    </script>
</body>
</html>
