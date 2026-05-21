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
    <nav class="fixed w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
    <div class="max-w-full mx-auto px-10 flex justify-between items-center h-20">
        <a href="/" class="font-bold text-2xl tracking-wider">{{ $profile->name ?? 'Portofolio' }}<span class="text-indigo-500">.</span></a>

        <div class="hidden md:flex space-x-8">
            <a href="#home" class="nav-link text-slate-300 hover:text-indigo-400 transition font-medium">Home</a>
            <a href="#about" class="nav-link text-slate-300 hover:text-indigo-400 transition font-medium">About</a>
            <a href="#portfolio" class="nav-link text-slate-300 hover:text-indigo-400 transition font-medium">Portfolio</a>
            <a href="#contact" class="nav-link text-slate-300 hover:text-indigo-400 transition font-medium">Contact</a>
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

        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll("section");
            const navLinks = document.querySelectorAll(".nav-link");

            window.addEventListener("scroll", () => {
                let current = "";

                // Mengecek posisi scroll saat ini
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;

                    // -100 adalah angka toleransi offset navbar agar tidak telat pindah warna
                    if (pageYOffset >= (sectionTop - 100)) {
                        current = section.getAttribute("id");
                    }
                });

                // Menghapus dan menambahkan warna aktif (indigo-500) di navbar
                navLinks.forEach((link) => {
                    // Reset warna ke default (abu-abu/slate)
                    link.classList.remove("text-indigo-400");
                    link.classList.add("text-slate-300");

                    // Tambahkan warna biru pada menu yang aktif
                    if (link.getAttribute("href").includes(current)) {
                        link.classList.remove("text-slate-300");
                        link.classList.add("text-indigo-400");
                    }
                });
            });
        });
    </script>
</body>
</html>
