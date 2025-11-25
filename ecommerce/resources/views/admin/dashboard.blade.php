<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard — Buggxit Couture</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 font-[WalkwayRounded]">
    <header class="bg-black text-[rgb(193,146,43)] px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('logo.png') }}" class="h-8" alt="Buggxit Logo">
            <span class="uppercase font-semibold">Admin Dashboard</span>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">Logout</button>
        </form>
    </header>

    <main class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold uppercase text-[rgb(193,146,43)]">Welcome, Admin</h1>
        <p class="mt-2 text-gray-700">This is your dashboard. Features coming soon.</p>
    </main>
</body>
</html>