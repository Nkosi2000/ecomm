<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Buggxit Couture Est.2018</title>
    @vite('resources/css/app.css')
    <!-- Onest Font -->
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-[WalkwayRounded] flex flex-col min-h-screen">

    <!-- Header / Navigation -->
    <header x-data="{ open: false }" class="bg-black shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/">
                        <img src="{{ asset('logo.png') }}" alt="Buggxit Couture Logo" class="h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-10 items-center">
                    @foreach ($menus as $menu)
                        <a href="{{ $menu->url }}"
                           class="uppercase relative px-2 py-1 text-[rgb(193,146,43)] hover:text-white font-medium 
                           after:block after:h-0.5 after:bg-[rgb(193,146,43)] after:scale-x-0 hover:after:scale-x-100 
                           after:transition after:duration-300 after:origin-left
                           {{ request()->is(trim($menu->url, '/')) ? 'text-white font-semibold border-b-2 border-[rgb(193,146,43)]' : '' }}">
                            {{ $menu->label }}
                        </a>
                    @endforeach
                </nav>

                <!-- User Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login" class="uppercase text-[rgb(193,146,43)] hover:text-white font-medium transition-colors">Login</a>
                    <a href="/register" class="uppercase bg-[rgb(193,146,43)] text-black px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium transition-colors">
                        Sign Up
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-[rgb(193,146,43)] focus:outline-none">
                        <!-- Hamburger Icon -->
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- X Icon -->
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden px-4 pt-2 pb-4 space-y-3 bg-black shadow-lg rounded text-center">
            @foreach ($menus as $menu)
                <a href="{{ $menu->url }}"
                class="uppercase block px-3 py-2 text-[rgb(193,146,43)] hover:text-white font-medium rounded transition-colors">
                    {{ $menu->label }}
                </a>
            @endforeach
            <div class="mt-3 space-y-2">
                <a href="/login" class="uppercase block px-3 py-2 text-[rgb(193,146,43)] hover:text-white font-medium rounded">Login</a>
                <a href="/register" class="uppercase block px-3 py-2 bg-[rgb(193,146,43)] text-black rounded-lg hover:bg-white hover:text-black font-medium transition-colors">
                    Sign Up
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow">
        <section class="p-8 text-center">
            <h2 class="text-3xl font-bold mb-4 text-gray-900 uppercase">Shop the Latest Products</h2>
            <p class="text-lg text-gray-600">Discover amazing deals and new arrivals curated for you.</p>
            <a href="/products" class="mt-6 inline-block uppercase bg-[rgb(193,146,43)] text-black px-6 py-3 rounded-lg shadow hover:bg-white hover:text-black transition-colors">
                Browse Products
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-[rgb(193,146,43)] mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">

            <!-- Column 1: Brand -->
            <div>
                <img src="{{ asset('logo.png') }}" alt="Buggxit Couture Logo" class="h-12 mx-auto md:mx-0 mb-4">
                <p class="uppercase font-semibold">Buggxit Couture</p>
                <p class="text-sm">Est. 2018 — Luxury Fashion</p>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="uppercase font-semibold mb-3">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/about" class="hover:text-white transition">About Us</a></li>
                    <li><a href="/products" class="hover:text-white transition">Shop</a></li>
                    <li><a href="/contact" class="hover:text-white transition">Contact</a></li>
                    <li><a href="/faq" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>

            <!-- Column 3: Admin Access -->
            <div>
                <h3 class="uppercase font-semibold mb-3">Admin</h3>
                <p class="text-sm mb-2">Restricted access</p>
                <a href="/admin/login" class="inline-flex items-center justify-center bg-[rgb(193,146,43)] text-black px-4 py-2 rounded-lg hover:bg-white hover:text-black transition">
                    <!-- Admin Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zm0 0v1m0 4h.01M6.938 4.938a9 9 0 1110.124 0A9 9 0 016.938 4.938z" />
                    </svg>
                    Admin Login
                </a>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-[rgb(193,146,43)] mt-6 pt-4 text-center text-sm">
            &copy; 2018 Buggxit Couture — All Rights Reserved
        </div>
    </footer>

</body>
</html>