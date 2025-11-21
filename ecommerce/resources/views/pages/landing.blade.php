<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Buggxit Couture Est.2018</title>
    @vite('resources/css/app.css')
    <!-- Modern Font -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-onest">

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
                           class="uppercase relative px-2 py-1 text-gray-700 hover:text-blue-600 font-medium 
                           after:block after:h-0.5 after:bg-blue-600 after:scale-x-0 hover:after:scale-x-100 
                           after:transition after:duration-300 after:origin-left
                           {{ request()->is(trim($menu->url, '/')) ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">
                            {{ $menu->label }}
                        </a>
                    @endforeach
                </nav>

                <!-- User Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login" class="uppercase text-gray-700 hover:text-blue-600 font-medium transition-colors">Login</a>
                    <a href="/register" class="uppercase bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium transition-colors">
                        Sign Up
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden px-4 pt-2 pb-4 space-y-3 bg-white shadow-lg rounded">
            @foreach ($menus as $menu)
                <a href="{{ $menu->url }}"
                   class="uppercase block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium rounded transition-colors">
                    {{ $menu->label }}
                </a>
            @endforeach
            <div class="mt-3 space-y-2">
                <a href="/login" class="uppercase block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium rounded">Login</a>
                <a href="/register" class="uppercase block px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    Sign Up
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="p-8 text-center">
        <h2 class="text-3xl font-bold mb-4 text-gray-900">Shop the Latest Products</h2>
        <p class="text-lg text-gray-600">Discover amazing deals and new arrivals curated for you.</p>
        <a href="/products" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition-colors">
            Browse Products
        </a>
    </section>

    <!-- Footer -->
    <footer class="p-6 bg-gray-200 text-center text-gray-700">
        &copy; 2018 Buggxit Couture — All Rights Reserved
    </footer>

</body>
</html>